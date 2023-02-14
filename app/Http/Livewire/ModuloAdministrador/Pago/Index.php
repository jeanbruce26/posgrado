<?php

namespace App\Http\Livewire\ModuloAdministrador\Pago;

use App\Models\CanalPago;
use App\Models\HistorialAdministrativo;
use App\Models\Pago;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';
    public $modo = 1;
    public $pago_id;
    public $titulo = 'Crear Pago';

    public $documento;
    public $numero_operacion;
    public $monto;
    public $fecha_pago;
    public $canal_pago;
    
    protected $listeners = ['render', 'deletePago'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'numero_operacion' => 'required|numeric',
            'documento' => 'required|digits_between:8,9|numeric',
            'monto' => 'required|numeric',
            'fecha_pago' => 'required|date',
            'canal_pago' => 'required|numeric'
        ]);
    }

    public function modo()  
    {
        $this->limpiar();
        $this->modo = 1;
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('documento','numero_operacion','monto','fecha_pago','canal_pago');
        $this->modo = 1;
        $this->titulo = "Crear Pago";
    }

    public function cargarIdPago(Pago $pago)
    {
        $this->limpiar();
        $this->modo = 2;
        $this->titulo = 'Actualizar Pago - Nro Operación: '  . $pago->nro_operacion;
        $this->pago_id = $pago->pago_id;
        
        $this->documento = $pago->dni;
        $this->numero_operacion = $pago->nro_operacion;
        $this->monto = number_format($pago->monto,2);
        $this->fecha_pago = $pago->fecha_pago;
        $this->canal_pago = $pago->canal_pago_id;
    }

    public function guardarPago()
    {
        $this->validate([
            'numero_operacion' => 'required|numeric',
            'documento' => 'required|digits_between:8,9|numeric',
            'monto' => 'required|numeric',
            'fecha_pago' => 'required|date',
            'canal_pago' => 'required|numeric'
        ]);

        //validacion de numero de operacion repetido y dni repetido en el mismo dia
        if ($this->modo == 1) {
            $validar = Pago::where('nro_operacion', $this->numero_operacion)->first();
            
            if ($validar) {
                if($validar->dni == $this->documento && $validar->fecha_pago == $this->fecha_pago){
                    $this->dispatchBrowserEvent('alertaPago', [
                        'titulo' => '¡Alerta!',
                        'subtitulo' => 'El número de operación y el DNI ya han sido ingresado el día de hoy.',
                        'icon' => 'error'
                    ]);
                    return back();
                }else if ($validar->fecha_pago == $this->fecha_pago) {
                    $this->dispatchBrowserEvent('alertaPago', [
                        'titulo' => '¡Alerta!',
                        'subtitulo' => 'El número de operación ya ha sido ingresado el día de hoy.',
                        'icon' => 'error'
                    ]);
                    return back();
                }else if($validar->dni == $this->documento){
                    $this->dispatchBrowserEvent('alertaPago', [
                        'titulo' => '¡Alerta!',
                        'subtitulo' => 'El número de operación y el DNI ya existen en el registro de pagos.',
                        'icon' => 'error'
                    ]);
                    return back();
                }
            }
        }

        if ($this->modo == 1) {
            $pago = Pago::create([
                "dni" => $this->documento,
                "nro_operacion" => $this->numero_operacion,
                "monto" => $this->monto,
                "fecha_pago" => $this->fecha_pago,
                "estado" => 1,
                "canal_pago_id" => $this->canal_pago,
            ]);
    
            $this->subirHistorial($pago->pago_id, 'Creación de Pago', 'pago');
            $this->dispatchBrowserEvent('notificacionPago', ['message' =>'Pago creado satisfactoriamente.', 'color' => '#2eb867']);
        }else{
            $pago = Pago::find($this->pago_id);
            $pago->dni = $this->documento;
            $pago->nro_operacion = $this->numero_operacion;
            $pago->monto = $this->monto;
            $pago->fecha_pago = $this->fecha_pago;
            $pago->canal_pago_id = $this->canal_pago;
            $pago->save();

            $this->subirHistorial($pago->pago_id, 'Actualización de Pago', 'pago');
            $this->dispatchBrowserEvent('notificacionPago', ['message' =>'Pago '.$this->numero_operacion.' actualizado satisfactoriamente.', 'color' => '#2eb867']);
        }

        $this->dispatchBrowserEvent('modalPago');

        $this->limpiar();
    }

    public function eliminar($pago_id)
    {
        $this->dispatchBrowserEvent('deletePago', ['id' => $pago_id]);
    }

    public function deletePago(Pago $pago)
    {
        $pago->delete();

        $this->subirHistorial($pago->pago_id, 'Eliminación de Pago', 'pago');
        $this->dispatchBrowserEvent('notificacionPago', ['message' =>'Pago eliminado satisfactoriamente.', 'color' => '#ea4b43']);
    }

    
    public function subirHistorial($usuario_id, $descripcion, $tabla)
    {
        HistorialAdministrativo::create([
            "usuario_id" => auth('admin')->user()->usuario_id,
            "trabajador_id" => auth('admin')->user()->TrabajadorTipoTrabajador->Trabajador->trabajador_id,
            "historial_descripcion" => $descripcion,
            "historial_tabla" => $tabla,
            "historial_usuario_id" => $usuario_id,
            "historial_fecha" => now()
        ]);
    }



    public function render()
    {
        $buscar = $this->search;
        $pago = Pago::where('fecha_pago','LIKE',"%{$buscar}%")
                ->orWhere('dni','LIKE',"%{$buscar}%")
                ->orWhere('nro_operacion','LIKE',"%{$buscar}%")
                ->orWhere('pago_id','LIKE',"%{$buscar}%")
                ->orderBy('pago_id','DESC')->paginate(200);
        $canalPago = CanalPago::all();
        return view('livewire.modulo-administrador.pago.index', [
            'pago' => $pago,
            'canalPago' => $canalPago
        ]);
    }
}

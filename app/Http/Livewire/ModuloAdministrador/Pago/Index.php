<?php

namespace App\Http\Livewire\ModuloAdministrador\Pago;

use App\Models\Admision;
use App\Models\CanalPago;
use App\Models\HistorialAdministrativo;
use App\Models\Inscripcion;
use App\Models\InscripcionPago;
use App\Models\Pago;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => ''],
        'filtro_estado' => ['except' => [1,2,3,4,5]],
        'sort_nombre' => ['except' => 'pago_id'],
        'sort_direccion' => ['except' => 'desc'],
    ];

    public $search = '';
    public $modo = 1;
    public $pago_id;
    public $titulo = 'Crear Pago';

    public $sort_nombre = 'pago_id'; // Columna de la tabla a ordenar
    public $sort_direccion = 'desc'; // Orden de la columna a ordenar

    public $documento;
    public $numero_operacion;
    public $monto;
    public $fecha_pago;
    public $canal_pago;
    public $filtro_estado = [1,2,3,4,5]; 
    
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
                        'subtitulo' => 'El número de operación y el DNI ya se encuentran registrados en el sistema.',
                        'icon' => 'error'
                    ]);
                    return back();
                }else if ($validar->fecha_pago == $this->fecha_pago) {
                    $this->dispatchBrowserEvent('alertaPago', [
                        'titulo' => '¡Alerta!',
                        'subtitulo' => 'El número de operación ya ha sido ingresado en la fecha seleccionada.',
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
                "estado" => 2,
                "canal_pago_id" => $this->canal_pago,
            ]);

            //  obtener el ultimo codigo de inscripcion
            $ultimo_codifo_inscripcion = Inscripcion::orderBy('inscripcion_codigo','DESC')->first();
            if($ultimo_codifo_inscripcion == null)
            {
                $codigo_inscripcion = 'IN0001';
            }else
            {
                $codigo_inscripcion = $ultimo_codifo_inscripcion->inscripcion_codigo;
                $codigo_inscripcion = substr($codigo_inscripcion, 2, 6);
                $codigo_inscripcion = intval($codigo_inscripcion) + 1;
                $codigo_inscripcion = str_pad($codigo_inscripcion, 4, "0", STR_PAD_LEFT);
                $codigo_inscripcion = 'IN'.$codigo_inscripcion;
            }

            // crear la inscripcion
            $inscripcion = new Inscripcion();
            $inscripcion->inscripcion_codigo = $codigo_inscripcion;
            $inscripcion->estado = 'activo';
            $inscripcion->admision_cod_admi = Admision::where('estado', 1)->first()->cod_admi;
            $inscripcion->save();

            // asigar el pago creado a la tabla de inscripcion pago
            $inscripcion_pago = new InscripcionPago();
            $inscripcion_pago->pago_id = $pago->pago_id;
            $inscripcion_pago->inscripcion_id = $inscripcion->id_inscripcion;
            $inscripcion_pago->concepto_pago_id = 1;
            $inscripcion_pago->save();
    
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

    public function sort($value)
    {
        if ($this->sort_nombre == $value) {
            if ($this->sort_direccion == 'asc') {
                $this->sort_direccion = 'desc';
            } else {
                $this->sort_direccion = 'asc';
            }
        } else {
            $this->sort_nombre = $value;
            $this->sort_direccion = 'asc';
        }
    }

    public function render()
    {
        $buscar = $this->search;
        $pago = Pago::where(function($query) use ($buscar){
                    $query->where('fecha_pago','LIKE',"%{$buscar}%")
                    ->orWhere('dni','LIKE',"%{$buscar}%")
                    ->orWhere('nro_operacion','LIKE',"%{$buscar}%")
                    ->orWhere('pago_id','LIKE',"%{$buscar}%");
                })
                ->where(function($query){
                    foreach ($this->filtro_estado as $key => $value) {
                        if ($value == 1) {
                            $query->orWhere('estado', 1);
                        }else if ($value == 2) {
                            $query->orWhere('estado', 2);
                        }else if ($value == 3) {
                            $query->orWhere('estado', 3);
                        }else if ($value == 4) {
                            $query->orWhere('estado', 4);
                        }else if ($value == 5) {
                            $query->orWhere('estado', 5);
                        }
                    }
                    // $query->where('estado', 4)
                    // ->orWhere('estado', 5)
                    // ->orWhere('estado', 6);
                })
                ->orderBy($this->sort_nombre, $this->sort_direccion)
                ->paginate(200);
        $canalPago = CanalPago::all();
        return view('livewire.modulo-administrador.pago.index', [
            'pago' => $pago,
            'canalPago' => $canalPago
        ]);
    }
}

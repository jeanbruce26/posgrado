<?php

namespace App\Http\Livewire\ModuloAdministrador\Pago;

use App\Models\CanalPago;
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
        if ($this->modo == 1) {
            $this->validate([
                'numero_operacion' => 'required|numeric',
                'documento' => 'required|digits_between:8,9|numeric',
                'monto' => 'required|numeric',
                'fecha_pago' => 'required|date',
                'canal_pago' => 'required|numeric'
            ]);
    
            Pago::create([
                "dni" => $this->documento,
                "nro_operacion" => $this->numero_operacion,
                "monto" => $this->monto,
                "fecha_pago" => $this->fecha_pago,
                "estado" => 1,
                "canal_pago_id" => $this->canal_pago,
            ]);
    
            $this->dispatchBrowserEvent('notificacionPago', ['message' =>'Pago agregado satisfactoriamente.', 'color' => '#2eb867']);
        }else{
            $this->validate([
                'numero_operacion' => 'required|numeric',
                'documento' => 'required|digits_between:8,9|numeric',
                'monto' => 'required|numeric',
                'fecha_pago' => 'required|date',
                'canal_pago' => 'required|numeric'
            ]);
            
            $pago = Pago::find($this->pago_id);
            $pago->dni = $this->documento;
            $pago->nro_operacion = $this->numero_operacion;
            $pago->monto = $this->monto;
            $pago->fecha_pago = $this->fecha_pago;
            $pago->canal_pago_id = $this->canal_pago;
            $pago->save();

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

        $this->dispatchBrowserEvent('notificacionPago', ['message' =>'Pago eliminado satisfactoriamente.', 'color' => '#ea4b43']);
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

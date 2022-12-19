<?php

namespace App\Http\Livewire\ModuloAdministrador\ConceptoPago;

use App\Models\ConceptoPago;
use App\Models\HistorialAdministrativo;
use Livewire\Component;

class Index extends Component
{

    public $search = '';
    public $titulo = 'Crear Concepto de Pago';
    public $modo = 1; 
    //1=new / 2=update

    public $conceptoPago_id;

    public $concepto;
    public $monto;
    public $estado;

    protected $listeners = ['render', 'cambiarEstado'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'concepto' => 'required|string',
            'monto' => 'required|numeric'
        ]);
    }

    public function modo(){
        $this->limpiar();
        $this->modo = 1;
    }

    public function limpiar(){
        $this->resetErrorBag();
        $this->reset('concepto','monto');
        $this->modo = 1;
        $this->titulo = 'Crear Concepto de Pago';
    }

    public function cargarAlerta($id){
        $this->dispatchBrowserEvent('alertaConfirmacionConceptoPago', ['id' => $id]);
    }

    public function cambiarEstado(ConceptoPago $conceptoPago){
        if ($conceptoPago->estado == 1) {
            $conceptoPago->estado = 0;
        } else {
            $conceptoPago->estado = 1;
        }

        $conceptoPago->save();
        $this->subirHistorial($conceptoPago->concepto_id, 'Actualizacion de estado Concepto de Pago', 'concepto_pago');
    }

    public function cargarConceptoPago(ConceptoPago $conceptoPago){
        $this->limpiar();

        $this->modo = 2;
        $this->titulo = 'Actualizar Concepto de Pago';
        $this->conceptoPago_id = $conceptoPago->concepto_id;

        $this->concepto = $conceptoPago->concepto;
        $this->monto = $conceptoPago->monto;
    }

    public function guardarConceptoPago(){
        // dd($this->all());

        if ($this->modo == 1) {
            $this->validate([
                'concepto' => 'required|string',
                'monto' => 'required|numeric'
            ]);

            ConceptoPago::create([
                "concepto" => $this->concepto,
                "monto" => $this->monto,
                "estado" => 1
            ]);
        } else {
            $this->validate([
                'concepto' => 'required|string',
                'monto' => 'required|numeric'
            ]);

            $conceptoPago = ConceptoPago::find($this->conceptoPago_id);
            $conceptoPago->concepto = $this->concepto;
            $conceptoPago->monto = $this->monto;
            $conceptoPago->save();
        }

        $this->dispatchBrowserEvent('notificacionConceptoPago', ['message' =>'Concepto de Pago actualizado satisfactoriamente.', 'color' => '#2eb867']);

        $this->dispatchBrowserEvent('modalConceptoPago');

        $this->limpiar();
        
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
        $conceptoPagoModel = ConceptoPago::where('concepto_id','LIKE',"%{$buscar}%")
                        ->orWhere('concepto','LIKE',"%{$buscar}%")
                        ->orderBy('concepto_id','DESC')->get();
        return view('livewire.modulo-administrador.concepto-pago.index', [
            'conceptoPagoModel' => $conceptoPagoModel,
        ]);
    }
}

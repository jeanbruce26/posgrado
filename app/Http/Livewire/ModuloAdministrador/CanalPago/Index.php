<?php

namespace App\Http\Livewire\ModuloAdministrador\CanalPago;

use App\Models\CanalPago;
use Livewire\Component;

class Index extends Component
{

    public $search = '';
    public $titulo = 'Crear Canal de Pago';
    public $modo = 1; 
    //1=new / 2=update

    public $canalPago_id;

    public $canalPago;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'canalPago' => 'required|string',
        ]);
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('canalPago');
        $this->modo = 1;
        $this->titulo = "Crear Canal de Pago";
    }

    public function modo()  
    {
        $this->limpiar();
        $this->modo = 1;
    }

    public function cargarCanalPago(CanalPago $canalPago){
        $this->limpiar();
        $this->modo = 2;
        $this->titulo = 'Actualizar Canal de Pago';
        $this->canalPago_id = $canalPago->canal_pago_id;

        $this->canalPago = $canalPago->descripcion;
    }

    public function guardarCanalPago(){
        if($this->modo == 1){
            $this->validate([
                'canalPago' => 'required|string'
            ]);

            CanalPago::create([
                "descripcion" => $this->canalPago
            ]);

            $this->dispatchBrowserEvent('notificacionCanalPago', ['message' =>'Canal de Pago agregado satisfactoriamente.', 'color' => '#2eb867']);
        }else{
            $this->validate([
                'canalPago' => 'required|string'
            ]);

            $canalPago = CanalPago::find($this->canalPago_id);
            $canalPago->descripcion = $this->canalPago;
            $canalPago->save();

            $this->dispatchBrowserEvent('notificacionCanalPago', ['message' =>'Canal de Pago actualizado satisfactoriamente.', 'color' => '#2eb867']);
        }

        $this->dispatchBrowserEvent('modalCanalPago');

        $this->limpiar();
    }

    public function render()
    {
        $buscar = $this->search;
        $canalPagoModel = CanalPago::where('canal_pago_id','LIKE',"%{$buscar}%")
                        ->orWhere('descripcion','LIKE',"%{$buscar}%")
                        ->orderBy('canal_pago_id','DESC')->get();
        return view('livewire.modulo-administrador.canal-pago.index',[
            'canalPagoModel' => $canalPagoModel,
        ]);

    }
}

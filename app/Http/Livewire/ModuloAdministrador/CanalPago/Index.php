<?php

namespace App\Http\Livewire\ModuloAdministrador\CanalPago;

use App\Models\CanalPago;
use App\Models\HistorialAdministrativo;
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

            $canalPago = CanalPago::create([
                "descripcion" => $this->canalPago
            ]);

            $this->subirHistorial($canalPago->canal_pago_id, 'Creación de Canal de Pago', 'canal_pago');
            $this->dispatchBrowserEvent('notificacionCanalPago', ['message' =>'Canal de Pago creado satisfactoriamente.', 'color' => '#2eb867']);
        }else{
            $this->validate([
                'canalPago' => 'required|string'
            ]);

            $canalPago = CanalPago::find($this->canalPago_id);
            $canalPago->descripcion = $this->canalPago;
            $canalPago->save();

            $this->subirHistorial($canalPago->canal_pago_id, 'Actualización de Canal de Pago', 'canal_pago');
            $this->dispatchBrowserEvent('notificacionCanalPago', ['message' =>'Canal de Pago actualizado satisfactoriamente.', 'color' => '#2eb867']);
        }

        $this->dispatchBrowserEvent('modalCanalPago');

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
        $canalPagoModel = CanalPago::where('canal_pago_id','LIKE',"%{$buscar}%")
                        ->orWhere('descripcion','LIKE',"%{$buscar}%")
                        ->orderBy('canal_pago_id','DESC')->get();
        return view('livewire.modulo-administrador.canal-pago.index',[
            'canalPagoModel' => $canalPagoModel,
        ]);

    }
}

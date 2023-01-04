<?php

namespace App\Http\Livewire\ModuloAdministrador\Expediente;

use App\Models\Expediente;
use App\Models\HistorialAdministrativo;
use Livewire\Component;

class Index extends Component
{

    public $search = '';
    public $titulo = 'Crear Expediente';
    public $modo = 1;
    //1=new / 2=update

    public $expediente_id;

    public $tipoDocumento;
    public $complemento;
    public $requerido;
    public $estado;

    protected $listeners = ['render', 'cambiarEstado'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'tipoDocumento' => 'required|string',
            'complemento' => 'nullable|string',
            'requerido' => 'required|numeric'
        ]);
    }

    public function modo(){
        $this->limpiar();
        $this->modo = 1;
    }

    public function limpiar(){
        $this->resetErrorBag();
        $this->reset('tipoDocumento', 'complemento', 'requerido');
        $this->modo = 1;
        $this->titulo = 'Crear Expediente';
    }

    public function cargarAlerta($id){
        $this->dispatchBrowserEvent('alertaConfirmacionExpediente', ['id' => $id]);
    }

    public function cambiarEstado(Expediente $expediente){
        if ($expediente->estado == 1) {
            $expediente->estado = 2;
        } else {
            $expediente->estado = 1;
        }

        $expediente->save();

        $this->dispatchBrowserEvent('notificacionExpediente', ['message' =>'Estado de expediente actualizado satisfactoriamente.', 'color' => '#2eb867']);
        $this->subirHistorial($expediente->cod_exp, 'Actualizacion de estado expediente', 'expediente');
    }

    public function cargarExpediente(Expediente $expediente){
        $this->modo = 2;
        $this->limpiar();

        $this->modo = 2;
        $this->titulo = 'Actualizar Expediente';
        $this->expediente_id = $expediente->cod_exp;

        $this->tipoDocumento = $expediente->tipo_doc;
        $this->complemento = $expediente->complemento;
        $this->requerido = $expediente->requerido;
    }

    public function guardarExpediente(){
        //dd($this->all());

        if($this->modo == 1){
            $this->validate([
                'tipoDocumento' => 'required|string',
                'complemento' => 'nullable|string',
                'requerido' => 'required|numeric'
            ]);

            $expediente = Expediente::create([
                "tipo_doc" => $this->tipoDocumento,
                "complemento" => $this->complemento,
                "requerido" => $this->requerido,
                "estado" => 1
            ]);

            $this->dispatchBrowserEvent('notificacionExpediente', ['message' =>'Expediente creado satisfactoriamente.', 'color' => '#2eb867']);
            $this->subirHistorial($expediente->cod_exp, 'Creación de Expediente', 'expediente');

        }else{
            $this->validate([
                'tipoDocumento' => 'required|string',
                'complemento' => 'nullable|string',
                'requerido' => 'required|numeric'
            ]);

            $expediente = Expediente::find($this->expediente_id);
            $expediente->tipo_doc = $this->tipoDocumento;
            $expediente->complemento = $this->complemento;
            $expediente->requerido = $this->requerido;
            $expediente->save();

            $this->dispatchBrowserEvent('notificacionExpediente', ['message' =>'Expediente actualizado satisfactoriamente.', 'color' => '#2eb867']);
            $this->subirHistorial($expediente->cod_exp, 'Actualizacion de Expediente', 'expediente');
        }

        $this->dispatchBrowserEvent('modalExpediente');

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
        $expedienteModel = Expediente::where('cod_exp','LIKE',"%{$buscar}%")
                            ->orwhere('tipo_doc','LIKE',"%{$buscar}%")
                            ->orwhere('complemento','LIKE',"%{$buscar}%")->get();
        return view('livewire.modulo-administrador.expediente.index',[
            'expedienteModel' => $expedienteModel,
        ]);
    }
}

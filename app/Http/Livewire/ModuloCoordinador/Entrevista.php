<?php

namespace App\Http\Livewire\ModuloCoordinador;

use Livewire\Component;
use App\Models\Inscripcion;
use App\Models\Evaluacion;
use App\Models\EvaluacionEntrevistaTitulo;
use App\Models\EvaluacionEntrevista;
use App\Models\EvaluacionEntrevistaItem;

class Entrevista extends Component
{
    public $inscripcion_id;
    public $evaluacion_id;
    public $evaluacion_entrevista_item_id;
    public $evaluacion_entrevista_item = null;
    public $nota;
    public $total;
    
    protected $listeners = ['render', 'evaluarEntrevista'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'nota' => 'required'
        ]);
        
        // $this->contarTotal();
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('nota');
    }

    public function contarTotal()
    {
        $eva = EvaluacionEntrevista::where('evaluacion_id',$this->evaluacion_id)->get();
        $this->total = 0;
        foreach($eva as $item){
            $this->total = $this->total + $item->evaluacion_entrevista_nota;
        }
    }

    public function cargarId($id)
    {
        $this->evaluacion_entrevista_item_id = $id;

        $this->evaluacion_entrevista_item = EvaluacionEntrevistaItem::find($id);

        $eva = EvaluacionEntrevista::where('evaluacion_entrevista_item_id',$this->evaluacion_entrevista_item_id)->where('evaluacion_id',$this->evaluacion_id)->first();
        
        if($eva){
            $this->nota = number_format($eva->evaluacion_entrevista_nota, 0);
        }
    }

    public function agregarNota()
    {
        $this->validate([
            'nota' => 'required'
        ]);

        // dd($this->all());

        $eva = EvaluacionEntrevista::where('evaluacion_entrevista_item_id',$this->evaluacion_entrevista_item_id)->where('evaluacion_id',$this->evaluacion_id)->first();
        
        if($eva){
            $eva->evaluacion_entrevista_nota = $this->nota;
            $eva->save();
            $this->dispatchBrowserEvent('notificacionNota', ['message' =>'Nota actualizada satisfactoriamente.']);
        }else{
            $eva_expe = EvaluacionEntrevista::create([
                "evaluacion_entrevista_nota" => $this->nota,
                "evaluacion_entrevista_item_id" => $this->evaluacion_entrevista_item_id,
                "evaluacion_id" => $this->evaluacion_id,
            ]);
            $this->dispatchBrowserEvent('notificacionNota', ['message' =>'Nota agregada satisfactoriamente.']);
        }
        
        $this->limpiar();

        $this->contarTotal();

        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function evaluar()
    {
        $eva = EvaluacionEntrevista::where('evaluacion_id',$this->evaluacion_id)->count();
        $eva_item = EvaluacionEntrevistaItem::count();
        
        if($eva == $eva_item){
            $this->dispatchBrowserEvent('alertaConfirmacionEntrevista');
        }else{
            session()->flash('danger', 'Faltan notas por ingresar.');
        }
    }

    public function evaluarEntrevista()
    {
        date_default_timezone_set("America/Lima");
        $evaluacion = Evaluacion::find($this->evaluacion_id);
        $inscripcion = Inscripcion::find($evaluacion->inscripcion_id);
        $evaluacion->nota_entrevista = $this->total;
        if($this->total <= $evaluacion->Puntaje->puntaje_minimo_entrevista){
            $evaluacion->evaluacion_observacion = 'Puntaje minimo no alcanzado en la Evaluacion de Expedientes.';
            $evaluacion->evaluacion_estado = 2;
        }else{
            $evaluacion->evaluacion_observacion = 'Evaluado.';
            $evaluacion->evaluacion_estado = 3;
        }
        $evaluacion->fecha_entrevista = today();

        $nota_entre = $this->total;
        $nota_expe = $evaluacion->nota_expediente;
        $evaluacion->nota_final = $nota_entre + $nota_expe;
        $evaluacion->save();
        return redirect()->route('coordinador.inscripciones',$inscripcion->id_mencion);
    }

    public function render()
    {
        date_default_timezone_set("America/Lima");
        $evaluacion_data = Evaluacion::find($this->evaluacion_id);
        $this->contarTotal();
        $boton = $evaluacion_data->nota_entrevista;
        $inscripcion = Inscripcion::find($evaluacion_data->inscripcion_id);
        $fecha = today();

        $evaluacion_entrevista_titulo = EvaluacionEntrevistaTitulo::all();

        return view('livewire.modulo-coordinador.entrevista', [
            'inscripcion' => $inscripcion,
            'evaluacion_data' => $evaluacion_data,
            'fecha' => $fecha,
            'boton' => $boton,
            'evaluacion_entrevista_titulo' => $evaluacion_entrevista_titulo,
        ]);
    }
}

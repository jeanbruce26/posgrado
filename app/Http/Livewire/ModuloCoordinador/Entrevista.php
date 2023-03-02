<?php

namespace App\Http\Livewire\ModuloCoordinador;

use Livewire\Component;
use App\Models\Inscripcion;
use App\Models\Evaluacion;
use App\Models\EvaluacionEntrevistaTitulo;
use App\Models\EvaluacionEntrevista;
use App\Models\EvaluacionEntrevistaItem;
use App\Models\ObservacionEvaluacion;
use App\Models\Puntaje;

class Entrevista extends Component
{
    public $inscripcion_id;
    public $tipo_evaluacion_id;
    public $evaluacion_id;
    public $puntaje;
    public $total = 0;
    public $evaluacion_entrevista_item_id;
    public $observacion;
    
    protected $listeners = [
        'render', 
        'evaluarEntrevista',
        'evaluarPaso2',
    ];

    public function updated($propertyName)
    {
        $eva_ent_item = EvaluacionEntrevistaItem::where('tipo_evaluacion_id',$this->tipo_evaluacion_id)->get();
        foreach($eva_ent_item as $item){
            if($item->evaluacion_entrevista_item_id == $this->evaluacion_entrevista_item_id){
                $this->validateOnly($propertyName, [
                    'puntaje'=> 'required|numeric|min:0|max:'.$item->evaluacion_entrevista_item_puntaje,
                ]);
            }
        }
        $this->contarTotal();
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('puntaje');
        $this->resetValidation();
    }

    public function cargarId(EvaluacionEntrevistaItem $id)
    {
        $this->limpiar();
        
        $this->evaluacion_entrevista_item_id = $id->evaluacion_entrevista_item_id;
        $eval_entre_item = EvaluacionEntrevistaItem::find($this->evaluacion_entrevista_item_id);
        $eva = EvaluacionEntrevista::where('evaluacion_entrevista_item_id',$eval_entre_item->evaluacion_entrevista_item_id)->where('evaluacion_id',$this->evaluacion_id)->first();
        if($eva){
            $this->puntaje = number_format($eva->evaluacion_entrevista_puntaje, 0);
        }
    }

    public function contarTotal()
    {
        $eva_ent_item = EvaluacionEntrevistaItem::where('tipo_evaluacion_id',$this->tipo_evaluacion_id)->get();
        $this->total = 0;
        foreach($eva_ent_item as $item){
            $eva = EvaluacionEntrevista::where('evaluacion_entrevista_item_id',$item->evaluacion_entrevista_item_id)->where('evaluacion_id',$this->evaluacion_id)->first();
            if($eva){
                $this->total = $this->total + $eva->evaluacion_entrevista_puntaje;
            }
        }
    }

    public function agregarNota()
    {
        $eva_ent_item = EvaluacionEntrevistaItem::where('tipo_evaluacion_id',$this->tipo_evaluacion_id)->get();
        foreach($eva_ent_item as $item){
            if($item->evaluacion_entrevista_item_id == $this->evaluacion_entrevista_item_id){
                $this->validate([
                    'puntaje'=> 'required|numeric|min:0|max:'.$item->evaluacion_entrevista_item_puntaje,
                ]);
            }
        }

        $eva = EvaluacionEntrevista::where('evaluacion_entrevista_item_id',$this->evaluacion_entrevista_item_id)->where('evaluacion_id',$this->evaluacion_id)->first();
        
        if($eva){
            $eva->evaluacion_entrevista_puntaje = $this->puntaje;
            $eva->save();
            $this->dispatchBrowserEvent('notificacionNota', ['message' =>'Puntaje actualizada satisfactoriamente.']);
        }else{
            $eva_expe = EvaluacionEntrevista::create([
                "evaluacion_entrevista_puntaje" => $this->puntaje,
                "evaluacion_entrevista_item_id" => $this->evaluacion_entrevista_item_id,
                "evaluacion_id" => $this->evaluacion_id,
            ]);
            $this->dispatchBrowserEvent('notificacionNota', ['message' =>'Puntaje agregada satisfactoriamente.']);
        }
        
        $this->limpiar();
        $this->contarTotal();
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function evaluar()
    {
        $eva = EvaluacionEntrevista::where('evaluacion_id',$this->evaluacion_id)->count();
        $eva_item = EvaluacionEntrevistaItem::where('tipo_evaluacion_id',$this->tipo_evaluacion_id)->count();
        $evaluacion = Evaluacion::find($this->evaluacion_id);
        
        if($eva == $eva_item){
            if($this->tipo_evaluacion_id == 1){
                $this->dispatchBrowserEvent('alertaConfirmacionEntrevista', [
                        'mensaje' =>'El puntaje minimo para aprobar las evaluaciones de maestria es tener una sumatoria de ' . number_format($evaluacion->Puntaje->puntaje_minimo_final_maestria) . ' puntos.', 
                        'icon' => 'question', 
                        'titulo' => '¿Está seguro de evaluar la entrevista?', 
                        'button' => 'Si, continuar',
                        'metodo' => 'evaluarPaso2'
                    ]);
            }else{
                $this->dispatchBrowserEvent('alertaConfirmacionEntrevista', [
                        'mensaje' =>'El puntaje minimo para aprobar las evaluaciones de doctorado es tener una sumatoria de' . number_format($evaluacion->Puntaje->puntaje_minimo_final_doctorado) . ' puntos.', 
                        'icon' => 'question', 
                        'titulo' => '¿Está seguro de evaluar la entrevista?', 
                        'button' => 'Si, continuar',
                        'metodo' => 'evaluarPaso2'
                    ]);
            }
        }else{
            $this->dispatchBrowserEvent('alertaEntrevista', ['mensaje' =>'Faltan notas por ingresar', 'tipo' => 'error']);
            return back();
        }
    }

    public function evaluarPaso2()
    {
        $this->dispatchBrowserEvent('alertaConfirmacionEntrevista', [
            'mensaje' =>'Una vez evaluado no se podrá modificar las notas.', 
            'icon' => 'question', 
            'titulo' => '¿Está seguro de evaluar la entrevista?', 
            'button' => 'Si, evaluar',
            'metodo' => 'evaluarEntrevista'
        ]);
    }

    public function evaluarEntrevista()
    {
        $evaluacion = Evaluacion::find($this->evaluacion_id);
        $inscripcion = Inscripcion::find($evaluacion->inscripcion_id);
        $evaluacion->p_entrevista = $this->total;
        if($this->tipo_evaluacion_id == 1){
            $nota_final = $evaluacion->p_expediente + $this->total;
            if($nota_final < $evaluacion->Puntaje->puntaje_minimo_final_maestria){
                $evaluacion->evaluacion_observacion = 'Evaluación de entrevista jalada.';
                $evaluacion->evaluacion_estado = 2;
            }else{
                $evaluacion->evaluacion_observacion = 'Evaluado.';
                $evaluacion->evaluacion_estado = 3;
            }
        }else{
            $nota_final = $evaluacion->p_expediente + $evaluacion->p_investigacion + $this->total;
            if($nota_final < $evaluacion->Puntaje->puntaje_minimo_final_doctorado){
                $evaluacion->evaluacion_observacion = 'Evaluación de entrevista jalada.';
                $evaluacion->evaluacion_estado = 2;
            }else{
                $evaluacion->evaluacion_observacion = 'Evaluado.';
                $evaluacion->evaluacion_estado = 3;
            }
        }
        $evaluacion->fecha_entrevista = today();
        $evaluacion->p_final = $nota_final;
        $evaluacion->save();

        if($this->observacion){
            $observacion = new ObservacionEvaluacion();
            $observacion->observacion = $this->observacion;
            $observacion->tipo_observacion_evaluacion = 3; // 1 = Expediente, 2 = Tesis, 3 = Entrevista
            $observacion->fecha_observacion = now();
            $observacion->evaluacion_id = $this->evaluacion_id;
            $observacion->save();
        }

        return redirect()->route('coordinador.inscripciones',$inscripcion->id_mencion);
    }

    public function render()
    {
        $evaluacion_data = Evaluacion::find($this->evaluacion_id);
        $boton = $evaluacion_data->p_entrevista;
        $inscripcion = Inscripcion::find($evaluacion_data->inscripcion_id);
        $fecha = today();
        $evaluacion_entrevista_item = EvaluacionEntrevistaItem::where('tipo_evaluacion_id', $this->tipo_evaluacion_id)->get();
        $puntaje_model = Puntaje::where('puntaje_estado', 1)->first();
        $this->contarTotal();

        return view('livewire.modulo-coordinador.entrevista', [
            'inscripcion' => $inscripcion,
            'evaluacion_data' => $evaluacion_data,
            'fecha' => $fecha,
            'boton' => $boton,
            'evaluacion_entrevista_item' => $evaluacion_entrevista_item,
            'puntaje_model' => $puntaje_model,
        ]);
    }
}

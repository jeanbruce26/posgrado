<?php

namespace App\Http\Livewire\ModuloCoordinador;

use App\Models\Evaluacion;
use App\Models\EvaluacionInvestigacion;
use App\Models\EvaluacionInvestigacionItem;
use App\Models\Inscripcion;
use App\Models\Puntaje;
use Livewire\Component;

class Investigacion extends Component
{
    public $inscripcion_id;
    public $tipo_evaluacion_id;
    public $evaluacion_id;
    public $puntaje;
    public $total = 0;
    public $evaluacion_investigacion_item_id;

    protected $listeners = [
        'render', 
        'evaluarInvestigacion',
        'evaluarPaso2',
    ];

    public function updated($propertyName)
    {
        $eva_inv_item = EvaluacionInvestigacionItem::all();
        foreach($eva_inv_item as $item){
            if($item->evaluacion_investigacion_item_id == $this->evaluacion_investigacion_item_id){
                $this->validateOnly($propertyName, [
                    'puntaje'=> 'required|numeric|min:0|max:'.$item->evaluacion_investigacion_item_puntaje,
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

    public function cargarId(EvaluacionInvestigacionItem $id)
    {
        $this->evaluacion_investigacion_item_id = $id->evaluacion_investigacion_item_id;
        $eval_inve_item = $id;
        $eva = EvaluacionInvestigacion::where('evaluacion_investigacion_item_id',$eval_inve_item->evaluacion_investigacion_item_id)->where('evaluacion_id',$this->evaluacion_id)->first();
        if($eva){
            $this->puntaje = number_format($eva->evaluacion_investigacion_puntaje, 0);
        }
    }

    public function contarTotal()
    {
        $eva_inves_item = EvaluacionInvestigacionItem::all();
        $this->total = 0;
        foreach($eva_inves_item as $item){
            $eva = EvaluacionInvestigacion::where('evaluacion_investigacion_item_id',$item->evaluacion_investigacion_item_id)->where('evaluacion_id',$this->evaluacion_id)->first();
            if($eva){
                $this->total = $this->total + $eva->evaluacion_investigacion_puntaje;
            }
        }
    }

    public function agregarNota()
    {
        $eva_inv_item = EvaluacionInvestigacionItem::all();
        foreach($eva_inv_item as $item){
            if($item->evaluacion_investigacion_item_id == $this->evaluacion_investigacion_item_id){
                $this->validate([
                    'puntaje'=> 'required|numeric|min:0|max:'.$item->evaluacion_investigacion_item_puntaje,
                ]);
            }
        }

        $eva = EvaluacionInvestigacion::where('evaluacion_investigacion_item_id',$this->evaluacion_investigacion_item_id)->where('evaluacion_id',$this->evaluacion_id)->first();
        
        if($eva){
            $eva->evaluacion_investigacion_puntaje = $this->puntaje;
            $eva->save();
            $this->dispatchBrowserEvent('notificacionPuntaje', ['message' =>'Puntaje actualizado satisfactoriamente.', 'color' => '#2eb867']);
        }else{
            $eva_expe = EvaluacionInvestigacion::create([
                "evaluacion_investigacion_puntaje" => $this->puntaje,
                "evaluacion_investigacion_item_id" => $this->evaluacion_investigacion_item_id,
                "evaluacion_id" => $this->evaluacion_id,
            ]);
            $this->dispatchBrowserEvent('notificacionPuntaje', ['message' =>'Puntaje agregado satisfactoriamente.', 'color' => '#2eb867']);
        }
        
        $this->limpiar();
        $this->contarTotal();
        $this->dispatchBrowserEvent('cerrarModal', ['modal' => '#modalNota']);
    }

    public function evaluar()
    {
        $eva = EvaluacionInvestigacion::where('evaluacion_id',$this->evaluacion_id)->count();
        $eva_item = EvaluacionInvestigacionItem::count();
        $evaluacion = Evaluacion::find($this->evaluacion_id);
        
        if($eva == $eva_item){
            $this->dispatchBrowserEvent('alertaConfirmacionInvestigacion', [
                    'mensaje' =>'El puntaje minimo para aprobar las evaluaciones de doctorado es tener una sumatoria de ' . number_format($evaluacion->Puntaje->puntaje_minimo_final_doctorado) . ' puntos.', 
                    'icon' => 'question', 
                    'titulo' => '¿Está seguro de evaluar la entrevista?', 
                    'button' => 'Si, continuar',
                    'metodo' => 'evaluarPaso2'
                ]);
        }else{
            $this->dispatchBrowserEvent('alertaInvestigacion', ['mensaje' =>'Faltan notas por ingresar', 'tipo' => 'error']);
            return back();
        }
    }

    public function evaluarPaso2()
    {
        $this->dispatchBrowserEvent('alertaConfirmacionInvestigacion', [
            'mensaje' =>'Una vez evaluado no se podrá modificar las notas.', 
            'icon' => 'question', 
            'titulo' => '¿Está seguro de evaluar el perfil de proyecto de investigacion?', 
            'button' => 'Si, evaluar',
            'metodo' => 'evaluarInvestigacion'
        ]);
    }

    public function evaluarInvestigacion()
    {
        $evaluacion = Evaluacion::find($this->evaluacion_id);
        $inscripcion = Inscripcion::find($evaluacion->inscripcion_id);
        $evaluacion->p_investigacion = $this->total;
        $evaluacion->fecha_investigacion = today();
        $evaluacion->save();

        return redirect()->route('coordinador.inscripciones',$inscripcion->id_mencion);
    }

    public function render()
    {
        $evaluacion_data = Evaluacion::find($this->evaluacion_id);
        $boton = $evaluacion_data->p_investigacion;
        $inscripcion = Inscripcion::find($evaluacion_data->inscripcion_id);
        $fecha = today();
        $evaluacion_investigacion_item = EvaluacionInvestigacionItem::all();
        $puntaje_model = Puntaje::where('puntaje_estado', 1)->first();
        $this->contarTotal();
        
        return view('livewire.modulo-coordinador.investigacion', [
            'evaluacion_data' => $evaluacion_data,
            'boton' => $boton,
            'inscripcion' => $inscripcion,
            'fecha' => $fecha,
            'evaluacion_investigacion_item' => $evaluacion_investigacion_item,
            'puntaje_model' => $puntaje_model
        ]);
    }
}
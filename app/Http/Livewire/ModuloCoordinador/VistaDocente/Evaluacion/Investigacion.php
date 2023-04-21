<?php

namespace App\Http\Livewire\ModuloCoordinador\VistaDocente\Evaluacion;

use App\Models\Evaluacion;
use App\Models\EvaluacionInvestigacion;
use App\Models\EvaluacionInvestigacionItem;
use App\Models\ExpedienteInscripcion;
use App\Models\Inscripcion;
use App\Models\ObservacionEvaluacion;
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
    public $observacion;

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
                $puntaje = number_format($item->evaluacion_investigacion_item_puntaje, 0);
                $this->validateOnly($propertyName, [
                    'puntaje'=> 'required|numeric|min:0|max:'.$puntaje,
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
        $this->limpiar();
        
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
                $puntaje = number_format($item->evaluacion_investigacion_item_puntaje, 0);
                $this->validate([
                    'puntaje'=> 'required|numeric|min:0|max:'.$puntaje,
                ]);
            }
        }

        $eva = EvaluacionInvestigacion::where('evaluacion_investigacion_item_id',$this->evaluacion_investigacion_item_id)->where('evaluacion_id',$this->evaluacion_id)->first();
        
        if($eva){
            $eva->evaluacion_investigacion_puntaje = $this->puntaje;
            $eva->save();
            // $this->dispatchBrowserEvent('notificacionPuntaje', ['message' =>'Puntaje actualizado satisfactoriamente.', 'color' => '#2eb867']);
        }else{
            $eva_expe = EvaluacionInvestigacion::create([
                "evaluacion_investigacion_puntaje" => $this->puntaje,
                "evaluacion_investigacion_item_id" => $this->evaluacion_investigacion_item_id,
                "evaluacion_id" => $this->evaluacion_id,
            ]);
            // $this->dispatchBrowserEvent('notificacionPuntaje', ['message' =>'Puntaje agregado satisfactoriamente.', 'color' => '#2eb867']);
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
                'mensaje' =>'Una vez evaluado no se podrá modificar las notas.', 
                'icon' => 'question', 
                'titulo' => '¿Está seguro de evaluar el perfil de proyecto de investigacion?', 
                'button' => 'Si, evaluar',
                'metodo' => 'evaluarInvestigacion'
            ]);
        }else{
            $this->dispatchBrowserEvent('alertaInvestigacion', ['mensaje' =>'Faltan notas por ingresar', 'tipo' => 'error']);
            return back();
        }
    }

    // public function evaluarPaso2()
    // {
    //     $this->dispatchBrowserEvent('alertaConfirmacionInvestigacion', [
    //         'mensaje' =>'Una vez evaluado no se podrá modificar las notas.', 
    //         'icon' => 'question', 
    //         'titulo' => '¿Está seguro de evaluar el perfil de proyecto de investigacion?', 
    //         'button' => 'Si, evaluar',
    //         'metodo' => 'evaluarInvestigacion'
    //     ]);
    // }

    public function evaluarInvestigacion()
    {
        $evaluacion = Evaluacion::find($this->evaluacion_id);
        $inscripcion = Inscripcion::find($evaluacion->inscripcion_id);
        $evaluacion->p_investigacion = $this->total;
        $evaluacion->fecha_investigacion = today();
        $evaluacion->save();

        if($this->observacion){
            $observacion = new ObservacionEvaluacion();
            $observacion->observacion = $this->observacion;
            $observacion->tipo_observacion_evaluacion = 2; // 1 = Expediente 2 = Tesis 3 = Entrevista
            $observacion->fecha_observacion = now();
            $observacion->evaluacion_id = $this->evaluacion_id;
            $observacion->save();
        }

        return redirect()->route('coordinador.docente.programas.inscripciones.index',$inscripcion->id_mencion);
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

        $expedientes = ExpedienteInscripcion::join('expediente', 'ex_insc.expediente_cod_exp', '=', 'expediente.cod_exp')
                        ->where('ex_insc.id_inscripcion',$evaluacion_data->inscripcion_id)
                        ->where(function($query) use ($inscripcion){
                            $query->where('expediente.expediente_tipo', 0)
                                ->orWhere('expediente.expediente_tipo', $inscripcion->tipo_programa);
                        })
                        ->get();

        return view('livewire.modulo-coordinador.vista-docente.evaluacion.investigacion', [
            'evaluacion_data' => $evaluacion_data,
            'boton' => $boton,
            'inscripcion' => $inscripcion,
            'fecha' => $fecha,
            'evaluacion_investigacion_item' => $evaluacion_investigacion_item,
            'puntaje_model' => $puntaje_model,
            'expedientes' => $expedientes,
        ]);
    }
}

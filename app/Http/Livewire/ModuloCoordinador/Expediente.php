<?php

namespace App\Http\Livewire\ModuloCoordinador;

use Livewire\Component;
use App\Models\Inscripcion;
use App\Models\Evaluacion;
use App\Models\EvaluacionEntrevista;
use App\Models\EvaluacionEntrevistaItem;
use App\Models\EvaluacionExpediente;
use App\Models\EvaluacionExpedienteTitulo;
use App\Models\EvaluacionInvestigacion;
use App\Models\EvaluacionInvestigacionItem;
use App\Models\ExpedienteInscripcion;
use App\Models\ExpedienteInscripcionSeguimiento;
use App\Models\ExpedienteTipoEvaluacion;
use App\Models\ExpedienteTipoSeguimiento;
use App\Models\ObservacionEvaluacion;
use App\Models\Puntaje;
use App\Models\TipoEvaluacion;

class Expediente extends Component
{
    public $inscripcion_id;
    public $evaluacion_id;
    public $tipo_evaluacion_id;
    public $puntaje;
    public $total = 0;
    public $id_eva_exp;
    // estado 1 => por evaluar
    // estado 2 => evaluacion observada
    // estado 3 => evaluado
    public $observacion;
    
    protected $listeners = ['render', 'evaluarPaso2', 'evaluarExpediente'];

    public function updated($propertyName)
    {
        $eva_exp_titulo = EvaluacionExpedienteTitulo::where('tipo_evaluacion_id',$this->tipo_evaluacion_id)->get();
        foreach($eva_exp_titulo as $item){
            if($item->evaluacion_expediente_titulo_id == $this->id_eva_exp){
                $puntaje = number_format($item->evaluacion_expediente_titulo_puntaje_maximo, 0);
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

    public function contarTotal()
    {
        $eva = EvaluacionExpediente::where('evaluacion_id',$this->evaluacion_id)->get();
        $this->total = 0;
        foreach($eva as $item){
            $this->total = $this->total + $item->evaluacion_expediente_puntaje;
        }
    }

    public function cargarId(EvaluacionExpedienteTitulo $evaluacion_expediente_titulo)
    {
        $this->limpiar();
        
        $this->id_eva_exp = $evaluacion_expediente_titulo->evaluacion_expediente_titulo_id;

        $eva = EvaluacionExpediente::where('evaluacion_expediente_titulo_id',$this->id_eva_exp)->where('evaluacion_id',$this->evaluacion_id)->first();
        if($eva){
            $this->puntaje = number_format($eva->evaluacion_expediente_puntaje, 0);
        }
    }

    public function agregarNota()
    {
        $eva_exp_titulo = EvaluacionExpedienteTitulo::where('tipo_evaluacion_id',$this->tipo_evaluacion_id)->get();
        foreach($eva_exp_titulo as $item){
            if($item->evaluacion_expediente_titulo_id == $this->id_eva_exp){
                $puntaje = number_format($item->evaluacion_expediente_titulo_puntaje_maximo, 0);
                $this->validate([
                    'puntaje'=> 'required|numeric|min:0|max:'.$puntaje,
                ]);
            }
        }

        $eva = EvaluacionExpediente::where('evaluacion_expediente_titulo_id',$this->id_eva_exp)->where('evaluacion_id',$this->evaluacion_id)->first();

        if($eva){
            $eva->evaluacion_expediente_puntaje = $this->puntaje;
            $eva->save();
            // $this->dispatchBrowserEvent('notificacionNota', ['message' =>'Puntaje actualizada satisfactoriamente.']);
        }else{
            $eva_expe = EvaluacionExpediente::create([
                "evaluacion_expediente_puntaje" => $this->puntaje,
                "evaluacion_expediente_titulo_id" => $this->id_eva_exp,
                "evaluacion_id" => $this->evaluacion_id,
            ]);
            // $this->dispatchBrowserEvent('notificacionNota', ['message' =>'Puntaje agregada satisfactoriamente.']);
        }

        $this->limpiar();
        $this->contarTotal();
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function evaluar()
    {
        $eva = EvaluacionExpediente::where('evaluacion_id',$this->evaluacion_id)->count(); // 
        $eva_expe_tit = EvaluacionExpedienteTitulo::where('tipo_evaluacion_id',$this->tipo_evaluacion_id)->count();
        $evaluacion = Evaluacion::find($this->evaluacion_id);

        if($this->tipo_evaluacion_id == 1){
            if($eva == $eva_expe_tit){
                $this->dispatchBrowserEvent('alertaConfirmacionExpedientePuntaje', ['puntaje' => number_format($evaluacion->Puntaje->puntaje_minimo_final_maestria) ]);
            }else{
                $this->dispatchBrowserEvent('alertaExpediente', ['mensaje' =>'Faltan notas por ingresar', 'tipo' => 'error']);
                return back();
            }
        }else{
            if($eva == $eva_expe_tit){
                $this->dispatchBrowserEvent('alertaConfirmacionExpedientePuntaje', ['puntaje' => number_format($evaluacion->Puntaje->puntaje_minimo_final_doctorado) ]);
            }else{
                $this->dispatchBrowserEvent('alertaExpediente', ['mensaje' =>'Faltan notas por ingresar', 'tipo' => 'error']);
                return back();
            }
        }
    }

    public function evaluarPaso2()
    {
        $this->dispatchBrowserEvent('alertaConfirmacionExpediente');
    }

    public function evaluarExpediente()
    {
        $evaluacion = Evaluacion::find($this->evaluacion_id);
        $inscripcion = Inscripcion::find($evaluacion->inscripcion_id);
        $evaluacion->p_expediente = $this->total;
        $evaluacion->fecha_expediente = today();
        $evaluacion->save();

        if($this->observacion){
            $observacion = new ObservacionEvaluacion();
            $observacion->observacion = $this->observacion;
            $observacion->tipo_observacion_evaluacion = 1; // 1 = Expediente 2 = Tesis 3 = Entrevista
            $observacion->fecha_observacion = now();
            $observacion->evaluacion_id = $this->evaluacion_id;
            $observacion->save();
        }

        $evaluacion = Evaluacion::find($this->evaluacion_id);
        if($this->total == 0){
            $evaluacion->p_expediente = 0;
            $evaluacion->fecha_expediente = today();
            $evaluacion->p_entrevista = 0;
            $evaluacion->fecha_entrevista = today();
            if($evaluacion->tipo_evaluacion_id == 2){
                $evaluacion->p_investigacion = 0;
                $evaluacion->fecha_investigacion = today();
            }
            $evaluacion->p_final = 0;
            $evaluacion->evaluacion_estado = 2;
            if($evaluacion->tipo_evaluacion_id == 2){
                $evaluacion->evaluacion_observacion = 'No cumple con el Grado Academico del Art. 68.';
            }else{
                $evaluacion->evaluacion_observacion = 'No cumple con el Grado Academico del Art. 51.';
            }
            $evaluacion->save();
        }

        $evaluacion_entrevista_item = EvaluacionEntrevistaItem::where('tipo_evaluacion_id',$evaluacion->tipo_evaluacion_id)->get(); 
        foreach($evaluacion_entrevista_item as $item){
            $evaluacion_entrevista = new EvaluacionEntrevista();
            $evaluacion_entrevista->evaluacion_entrevista_puntaje = 0;
            $evaluacion_entrevista->evaluacion_entrevista_item_id = $item->evaluacion_entrevista_item_id;
            $evaluacion_entrevista->evaluacion_id = $evaluacion->evaluacion_id;
            $evaluacion_entrevista->save();
        }

        if($evaluacion->tipo_evaluacion_id == 2){
            $evaluacion_investigacion_item = EvaluacionInvestigacionItem::where('evaluacion_investigacion_item_estado',1)->get(); 
            foreach($evaluacion_investigacion_item as $item){
                $evaluacion_investigacion = new EvaluacionInvestigacion();
                $evaluacion_investigacion->evaluacion_investigacion_puntaje = 0;
                $evaluacion_investigacion->evaluacion_investigacion_item_id = $item->evaluacion_investigacion_item_id;
                $evaluacion_investigacion->evaluacion_id = $evaluacion->evaluacion_id;
                $evaluacion_investigacion->save();
            }
        }

        return redirect()->route('coordinador.inscripciones',$inscripcion->id_mencion);
    }

    public function render()
    {
        $this->contarTotal();
        $evaluacion_data = Evaluacion::find($this->evaluacion_id);
        $tipo_evaluacion = TipoEvaluacion::find($this->tipo_evaluacion_id);
        $boton = $evaluacion_data->p_expediente;
        $inscripcion = Inscripcion::find($evaluacion_data->inscripcion_id);
        $fecha = today();

        $evaluacion_expediente = EvaluacionExpedienteTitulo::where('tipo_evaluacion_id', $this->tipo_evaluacion_id)->get();
        $puntaje_model = Puntaje::where('puntaje_estado', 1)->first();

        $seguimiento_expediente_count = ExpedienteInscripcionSeguimiento::join('ex_insc', 'ex_insc.cod_ex_insc', '=', 'expediente_inscripcion_seguimiento.cod_ex_insc')
                                                                        ->where('ex_insc.id_inscripcion', $evaluacion_data->inscripcion_id)
                                                                        ->where('expediente_inscripcion_seguimiento.expediente_inscripcion_seguimiento_estado', 1)
                                                                        ->where('expediente_inscripcion_seguimiento.tipo_seguimiento', 1)
                                                                        ->count();

        $expedientes = ExpedienteInscripcion::join('expediente', 'ex_insc.expediente_cod_exp', '=', 'expediente.cod_exp')
                        ->where('ex_insc.id_inscripcion',$evaluacion_data->inscripcion_id)
                        ->where(function($query) use ($inscripcion){
                            $query->where('expediente.expediente_tipo', 0)
                                ->orWhere('expediente.expediente_tipo', $inscripcion->tipo_programa);
                        })
                        ->get();

        return view('livewire.modulo-coordinador.expediente', [
            'inscripcion' => $inscripcion,
            'evaluacion_data' => $evaluacion_data,
            'tipo_evaluacion' => $tipo_evaluacion,
            'fecha' => $fecha,
            'boton' => $boton,
            'evaluacion_expediente' => $evaluacion_expediente,
            'puntaje_model' => $puntaje_model,
            'expedientes' => $expedientes,
            'seguimiento_expediente_count' => $seguimiento_expediente_count, // para ver si tiene seguimiento de su expediente
        ]);
    }
}

<?php

namespace App\Http\Livewire\ModuloCoordinador;

use Livewire\Component;
use App\Models\Inscripcion;
use App\Models\Evaluacion;
use App\Models\EvaluacionExpediente;
use App\Models\EvaluacionExpedienteTitulo;
use App\Models\ExpedienteInscripcion;
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
    
    protected $listeners = ['render', 'evaluarPaso2', 'evaluarExpediente'];

    public function updated($propertyName)
    {
        $eva_exp_titulo = EvaluacionExpedienteTitulo::where('tipo_evaluacion_id',$this->tipo_evaluacion_id)->get();
        foreach($eva_exp_titulo as $item){
            if($item->evaluacion_expediente_titulo_id == $this->id_eva_exp){
                $this->validateOnly($propertyName, [
                    'puntaje'=> 'required|numeric|min:0|max:'.$item->evaluacion_expediente_titulo_puntaje_maximo,
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
                $this->validate([
                    'puntaje'=> 'required|numeric|min:0|max:'.$item->evaluacion_expediente_titulo_puntaje_maximo,
                ]);
            }
        }

        $eva = EvaluacionExpediente::where('evaluacion_expediente_titulo_id',$this->id_eva_exp)->where('evaluacion_id',$this->evaluacion_id)->first();

        if($eva){
            $eva->evaluacion_expediente_puntaje = $this->puntaje;
            $eva->save();
            $this->dispatchBrowserEvent('notificacionNota', ['message' =>'Puntaje actualizada satisfactoriamente.']);
        }else{
            $eva_expe = EvaluacionExpediente::create([
                "evaluacion_expediente_puntaje" => $this->puntaje,
                "evaluacion_expediente_titulo_id" => $this->id_eva_exp,
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
        ]);
    }
}

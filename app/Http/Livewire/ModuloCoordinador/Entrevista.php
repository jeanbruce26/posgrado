<?php

namespace App\Http\Livewire\ModuloCoordinador;

use Livewire\Component;
use App\Models\Inscripcion;
use App\Models\Evaluacion;
use App\Models\EvaluacionEntrevistaTitulo;
use App\Models\EvaluacionEntrevista;
use App\Models\EvaluacionEntrevistaItem;
use App\Models\Puntaje;

class Entrevista extends Component
{
    public $inscripcion_id;
    public $evaluacion_id;
    public $evaluacion_entrevista_item_id;
    public $evaluacion_entrevista_item = null;
    public $nota;
    public $nota_total;
    public $total = 0;
    
    protected $listeners = [
        'render', 
        'evaluarEntrevista',
        'evaluarPaso2',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'nota' => 'required'
        ]);
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('nota');
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

        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function evaluar($total)
    {
        $eva = EvaluacionEntrevista::where('evaluacion_id',$this->evaluacion_id)->count();
        $eva_item = EvaluacionEntrevistaItem::count();
        $evaluacion = Evaluacion::find($this->evaluacion_id);
        $this->nota_total = $total;
        
        if($eva == $eva_item){
            if($this->nota_total < $evaluacion->Puntaje->puntaje_minimo_entrevista){
                $this->dispatchBrowserEvent('alertaConfirmacionEntrevista', [
                    'mensaje' =>'El puntaje minimo para aprobar la evaluacion de expediente es de ' . number_format($evaluacion->Puntaje->puntaje_minimo_entrevista) . ' puntos.', 
                    'icon' => 'question', 
                    'titulo' => '¿Está seguro de evaluar la entrevista?', 
                    'button' => 'Si, continuar',
                    'metodo' => 'evaluarPaso2'
                ]);
            }else{
                $this->dispatchBrowserEvent('alertaConfirmacionEntrevista', [
                    'mensaje' =>'Una vez evaluado no se podrá modificar las notas.', 
                    'icon' => 'question', 
                    'titulo' => '¿Está seguro de evaluar la entrevista?', 
                    'button' => 'Si, evaluar',
                    'metodo' => 'evaluarEntrevista'
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
        $evaluacion->nota_entrevista = $this->nota_total;
        if($this->nota_total < $evaluacion->Puntaje->puntaje_minimo_entrevista){
            $evaluacion->evaluacion_observacion = 'Evaluación de entrevista jalada.';
            $evaluacion->evaluacion_estado = 2;
        }else{
            $evaluacion->evaluacion_observacion = 'Evaluado.';
            $evaluacion->evaluacion_estado = 3;
        }
        $evaluacion->fecha_entrevista = today();

        $nota_entre = $this->nota_total;
        $nota_expe = $evaluacion->nota_expediente;
        $evaluacion->nota_final = ($nota_entre + $nota_expe) / 2;
        $evaluacion->save();
        return redirect()->route('coordinador.inscripciones',$inscripcion->id_mencion);
    }

    public function render()
    {
        $evaluacion_data = Evaluacion::find($this->evaluacion_id);
        $boton = $evaluacion_data->nota_entrevista;
        $inscripcion = Inscripcion::find($evaluacion_data->inscripcion_id);
        $fecha = today();

        $evaluacion_entrevista_titulo = EvaluacionEntrevistaTitulo::all();
        
        $puntaje = Puntaje::where('puntaje_estado', 1)->first();

        return view('livewire.modulo-coordinador.entrevista', [
            'inscripcion' => $inscripcion,
            'evaluacion_data' => $evaluacion_data,
            'fecha' => $fecha,
            'boton' => $boton,
            'evaluacion_entrevista_titulo' => $evaluacion_entrevista_titulo,
            'puntaje' => $puntaje,
        ]);
    }
}

<?php

namespace App\Http\Livewire\ModuloCoordinador;

use App\Models\Admision;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inscripcion;
use App\Models\Mencion;
use App\Models\Evaluacion;
use App\Models\Puntaje;

class Inscripciones extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => ''],
        'mostrar' => ['except' => '10']
    ];

    public $id_mencion;
    public $boton = 'disabled';
    public $search = '';
    public $mostrar = 10;

    public function evaExpe($id)
    {
        $admision = Admision::where('estado',1)->first(); // 1 = activo 0 = inactivo

        $fecha = today();

        $evaluacion = Evaluacion::where('inscripcion_id',$id)->first();
        $puntaje = Puntaje::where('puntaje_estado',1)->first();

        if($admision->fecha_evaluacion_expediente_inicio > $fecha || $admision->fecha_evaluacion_expediente_fin < $fecha){
            if($admision->fecha_evaluacion_expediente_inicio > $fecha){
                $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'La fecha de inicio de la evaluacion de expedientes es el: '. date('d/m/Y',strtotime($admision->fecha_evaluacion_expediente_inicio))]);
            }
            if($admision->fecha_evaluacion_expediente_fin < $fecha){
                $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Evaluaciones de expedientes finalizadas']);
            }
        }else{
            if($evaluacion){
                return redirect()->route('coordinador.expediente',$evaluacion->evaluacion_id);
            }else{
                $eva = Evaluacion::create([
                    "evaluacion_estado" => 1,
                    "puntaje_id" => $puntaje->puntaje_id,
                    "inscripcion_id" => $id,
                    "fecha_expediente" => $fecha,
                ]);
                
                return redirect()->route('coordinador.expediente',$eva->evaluacion_id);
            }
        }
    }


    public function evaEntre($id)
    {
        $admision = Admision::where('estado',1)->first(); // 1 = activo 0 = inactivo

        $fecha = today();

        $evaluacion = Evaluacion::where('inscripcion_id',$id)->first();
        
        if($admision->fecha_evaluacion_entrevista_inicio > $fecha || $admision->fecha_evaluacion_entrevista_fin < $fecha){
            if($admision->fecha_evaluacion_entrevista_inicio > $fecha){
                $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'La fecha de inicio de la evaluacion de entrevista es el: '. date('d/m/Y',strtotime($admision->fecha_evaluacion_entrevista_inicio))]);
            }
            if($admision->fecha_evaluacion_entrevista_fin < $fecha){
                $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Evaluaciones de entrevistas finalizadas']);
            }
        }else{
            if($evaluacion){
                if($evaluacion->nota_expediente){
                    return redirect()->route('coordinador.entrevista',$evaluacion->evaluacion_id);
                }else{
                    // session()->flash('message', 'Falta completar la Evaluacion de Expedientes.');
                    $this->dispatchBrowserEvent('errorEntrevista');
                }
            }else{
                // session()->flash('message', 'Falta completar la Evaluacion de Expedientes.');
                $this->dispatchBrowserEvent('errorEntrevista');
            }
        }
    }

    public function render()
    {
        $idmencion = $this->id_mencion;
        $buscar = $this->search;
        $inscripciones = Inscripcion::join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
            ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
            ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
            ->join('programa','subprograma.id_programa','=','programa.id_programa')
            ->where(function($query) use ($idmencion){$query->where('mencion.id_mencion',$idmencion);})
            ->where(function($query) use ($buscar){
                $query->where('persona.nombres','LIKE',"%{$buscar}%")
                    ->orWhere('persona.apell_pater','LIKE',"%{$buscar}%")
                    ->orWhere('persona.apell_mater','LIKE',"%{$buscar}%")
                    ->orWhere('persona.num_doc','LIKE',"%{$buscar}%")
                    ->orWhere('inscripcion.id_inscripcion','LIKE',"%{$buscar}%");
                })
            ->paginate($this->mostrar);

        $mencion = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
            ->join('programa','subprograma.id_programa','=','programa.id_programa')
            ->where('mencion.id_mencion',$idmencion)
            ->first();

        $inscripciones_count = Inscripcion::join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
            ->where('mencion.id_mencion',$idmencion)
            ->count();
        
        $evaluaciones_count = Evaluacion::join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
            ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
            ->where('mencion.id_mencion',$idmencion)
            ->where('evaluacion.evaluacion_estado','!=',1)
            ->count();

        $admision = Admision::where('estado',1)->first();

        return view('livewire.modulo-coordinador.inscripciones', [
            'inscripciones' => $inscripciones,
            'mencion' => $mencion,
            'evaluaciones_count' => $evaluaciones_count,
            'inscripciones_count' => $inscripciones_count,
            'admision' => $admision,
        ]);
    }
}

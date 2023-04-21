<?php

namespace App\Http\Livewire\ModuloCoordinador\VistaDocente\Evaluacion;

use App\Models\Admision;
use App\Models\Evaluacion;
use App\Models\Inscripcion as ModelsInscripcion;
use App\Models\Mencion;
use App\Models\UsuarioEvaluacionPrograma;
use Livewire\Component;
use Livewire\WithPagination;

class Inscripcion extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $id_mencion;
    public $boton = 'disabled';
    public $search = '';

    public function evaInvestigacion($id)
    {
        $admision = Admision::where('estado',1)->first(); // 1 = activo 0 = inactivo
        $fecha = today(); // fecha actual
        $evaluacion = Evaluacion::where('inscripcion_id',$id)->first(); // buscar si ya existe una evaluacion para esa inscripcion
        
        if($admision->fecha_evaluacion_entrevista_inicio > $fecha || $admision->fecha_evaluacion_entrevista_fin < $fecha){
            if($admision->fecha_evaluacion_entrevista_inicio > $fecha){
                $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'La fecha de inicio de la evaluacion de perfil de proyecto de investigacion es el: '. date('d/m/Y',strtotime($admision->fecha_evaluacion_entrevista_inicio))]);
            }
            if($admision->fecha_evaluacion_entrevista_fin < $fecha){
                $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Evaluaciones de perfil de proyecto de investigacion finalizadas']);
            }
        }else{
            if($evaluacion){
                if($evaluacion->p_expediente){
                    return redirect()->route('coordinador.evaluacion-docente.investigacion', [
                        'id' => $evaluacion->evaluacion_id,
                        'tipo' => $evaluacion->tipo_evaluacion_id
                    ]);
                }else{
                    $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Le falta completar la Evaluacion de Expediente']);
                }
            }else{
                $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Le falta completar la Evaluacion de Expediente']);
            }
        }
    }

    public function evaEntre($id, $tipo)
    {
        $admision = Admision::where('estado',1)->first(); // 1 = activo 0 = inactivo
        $fecha = today(); // fecha actual
        $evaluacion = Evaluacion::where('inscripcion_id',$id)->first(); // buscar si ya existe una evaluacion para esa inscripcion
        
        if($admision->fecha_evaluacion_entrevista_inicio > $fecha || $admision->fecha_evaluacion_entrevista_fin < $fecha){
            if($admision->fecha_evaluacion_entrevista_inicio > $fecha){
                $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'La fecha de inicio de la evaluacion de entrevista es el: '. date('d/m/Y',strtotime($admision->fecha_evaluacion_entrevista_inicio))]);
            }
            if($admision->fecha_evaluacion_entrevista_fin < $fecha){
                $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Evaluaciones de entrevistas finalizadas']);
            }
        }else{
            if($evaluacion){
                if($evaluacion->p_expediente){
                    if($tipo == 1){
                        return redirect()->route('coordinador.evaluacion-docente.entrevista', [
                            'id' => $evaluacion->evaluacion_id,
                            'tipo' => $evaluacion->tipo_evaluacion_id
                        ]);
                    }else{
                        if($evaluacion->p_investigacion == null){
                            $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Falta completar la evaluacion de perfil de proyecto de investigacion']);
                        }else{
                            return redirect()->route('coordinador.evaluacion-docente.entrevista', [
                                'id' => $evaluacion->evaluacion_id,
                                'tipo' => $evaluacion->tipo_evaluacion_id
                            ]);
                        }
                    }
                }else{ 
                    if($tipo == 1){
                        $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Falta completar la evaluacion de expediente']);
                    }else{
                        $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Falta completar la evaluacion de expediente y la evaluacion de perfil de proyecto de investigacion']);
                    }
                }
            }else{
                if($tipo == 1){
                    $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Falta completar la evaluacion de expediente']);
                }else{
                    $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Falta completar la evaluacion de expediente y la evaluacion de perfil de proyecto de investigacion']);
                }                
            }
        }
    }

    public function render()
    {
        $usuario_evaluacion = auth('evaluacion')->user();
        $usuario_evaluacion_programa = UsuarioEvaluacionPrograma::where('usuario_evaluacion_id',$usuario_evaluacion->usuario_evaluacion_id)->where('id_mencion',$this->id_mencion)->first();
        $idmencion = $this->id_mencion;
        $buscar = $this->search;
        if($usuario_evaluacion_programa->usuario_evaluacion_programa_cantidad == 0){
            $inscripciones = ModelsInscripcion::join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
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
                ->orderBy('persona.nombre_completo','ASC')
                ->get();
        }else{
            $inscripciones = ModelsInscripcion::join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
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
                ->orderBy('persona.nombre_completo','ASC')
                ->skip($usuario_evaluacion_programa->usuario_evaluacion_programa_inicio)
                ->take($usuario_evaluacion_programa->usuario_evaluacion_programa_cantidad)
                ->get();
        }

        $mencion = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
            ->join('programa','subprograma.id_programa','=','programa.id_programa')
            ->where('mencion.id_mencion',$idmencion)
            ->first();

        $inscripciones_count = ModelsInscripcion::join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
            ->where('mencion.id_mencion',$idmencion)
            ->count();
        
        $evaluaciones_count = Evaluacion::join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
            ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
            ->where('mencion.id_mencion',$idmencion)
            ->where('evaluacion.evaluacion_estado','!=',1)
            ->count();

        $admision = Admision::where('estado',1)->first();

        return view('livewire.modulo-coordinador.vista-docente.evaluacion.inscripcion', [
            'inscripciones' => $inscripciones,
            'mencion' => $mencion,
            'inscripciones_count' => $inscripciones_count,
            'evaluaciones_count' => $evaluaciones_count,
            'admision' => $admision
        ]);
    }
}

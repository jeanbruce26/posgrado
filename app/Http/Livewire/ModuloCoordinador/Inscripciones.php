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
        'mostrar' => [
            'except' => '50'
        ]
    ];

    public $id_mencion;
    public $boton = 'disabled';
    public $search = '';
    public $mostrar = 50;

    public function evaExpe($id)
    {
        $admision = Admision::where('estado',1)->first(); // 1 = activo 0 = inactivo
        $fecha = today(); // fecha actual
        $evaluacion = Evaluacion::where('inscripcion_id',$id)->first(); // buscar si ya existe una evaluacion para esa inscripcion
        $puntaje = Puntaje::where('puntaje_estado',1)->first(); // buscar el puntaje activo
        $mencion = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
            ->join('programa','subprograma.id_programa','=','programa.id_programa')
            ->where('mencion.id_mencion',$this->id_mencion)
            ->first();

        if($admision->fecha_evaluacion_expediente_inicio > $fecha || $admision->fecha_evaluacion_expediente_fin < $fecha){
            if($admision->fecha_evaluacion_expediente_inicio > $fecha){
                $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'La fecha de inicio de la evaluacion de expedientes es el: '. date('d/m/Y',strtotime($admision->fecha_evaluacion_expediente_inicio))]);
            }
            if($admision->fecha_evaluacion_expediente_fin < $fecha){
                $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Evaluaciones de expedientes finalizadas']);
            }
        }else{
            if($evaluacion){ // si ya existe una evaluacion
                $tipo_evaluacion = $evaluacion->tipo_evaluacion_id;
                return redirect()->route('coordinador.expediente', [
                    'id' => $evaluacion->evaluacion_id,
                    'tipo' => $tipo_evaluacion
                ]);
            }else{ // si no existe una evaluacion
                $eva = new Evaluacion();
                $eva->evaluacion_estado = 1;
                $eva->evaluacion_estado_admitido = 1; // 1 = sin codigo, 0 = con codigo y admitido
                $eva->puntaje_id = $puntaje->puntaje_id;
                $eva->inscripcion_id = $id;
                $eva->fecha_expediente = $fecha;
                if($mencion->descripcion_programa == 'DOCTORADO'){
                    $eva->tipo_evaluacion_id = 2;
                }else if($mencion->descripcion_programa == 'MAESTRIA'){
                    $eva->tipo_evaluacion_id = 1;
                }
                $eva->save();
                
                return redirect()->route('coordinador.expediente', [
                    'id' => $eva->evaluacion_id,
                    'tipo' => $eva->tipo_evaluacion_id
                ]);
            }
        }
    }

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
                    return redirect()->route('coordinador.investigacion', [
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
                        return redirect()->route('coordinador.entrevista', [
                            'id' => $evaluacion->evaluacion_id,
                            'tipo' => $evaluacion->tipo_evaluacion_id
                        ]);
                    }else{
                        if($evaluacion->p_investigacion == null){
                            $this->dispatchBrowserEvent('errorEvaluacion', ['mensaje' => 'Falta completar la evaluacion de perfil de proyecto de investigacion']);
                        }else{
                            return redirect()->route('coordinador.entrevista', [
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
            ->orderBy('persona.nombre_completo','ASC')
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

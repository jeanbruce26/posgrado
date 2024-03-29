<?php

namespace App\Http\Livewire\ModuloAdministrador\Evaluacion;

use App\Models\Evaluacion;
use App\Models\EvaluacionEntrevista;
use App\Models\EvaluacionEntrevistaItem;
use App\Models\EvaluacionExpediente;
use App\Models\EvaluacionExpedienteTitulo;
use App\Models\EvaluacionInvestigacion;
use App\Models\EvaluacionInvestigacionItem;
use App\Models\ExpedienteInscripcion;
use App\Models\Inscripcion;
use App\Models\Mencion;
use App\Models\Puntaje;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => ''],
        'filtro_programa' => ['except' => ''],
        'sort_nombre' => ['except' => 'nombre_completo'],
        'sort_direccion' => ['except' => 'asc'],
    ];

    public $search = '';

    // variables de filtros
    public $filtro_programa;

    // varioables para la eva de expediente y entrevista
    public $evaluacion_expediente_titulo_model;
    public $evaluacion_entrevista_item_model;
    public $evaluacion_entrevista_item_id;
    public $puntaje_model;
    public $expediente_model;
    public $puntaje;
    public $total_expediente;
    public $total_entrevista;
    public $id_inscripcion;
    public $id_eva_exp;
    public $evaluacion_id;
    
    public $sort_nombre = 'nombre_completo'; // Columna de la tabla a ordenar
    public $sort_direccion = 'asc'; // Orden de la columna a ordenar

    protected $listeners = [
        'render', 
        'cargar_eva_expediente',
        'evaluar_cero',
        'evaluar_reset'
    ];

    public function limpiar_filtro()
    {
        $this->reset('filtro_programa');
    }

    public function limpiar()
    {
        $this->reset('search', 'total_expediente', 'total_entrevista');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function contarTotal($evaluacion_id)
    {
        $eva = EvaluacionExpediente::where('evaluacion_id',$evaluacion_id)->get();
        $eva_entre = EvaluacionEntrevista::where('evaluacion_id',$evaluacion_id)->get();
        $this->total_expediente = 0;
        $this->total_entrevista = 0;
        foreach($eva as $item){
            $this->total_expediente = $this->total_expediente + $item->evaluacion_expediente_puntaje;
        }
        foreach($eva_entre as $item){
            $this->total_entrevista = $this->total_entrevista + $item->evaluacion_entrevista_puntaje;
        }
    }

    public function cargar_eva_expediente(Inscripcion $inscripcion)
    {
        $this->id_inscripcion = $inscripcion->id_inscripcion;
        $evaluacion = Evaluacion::where('inscripcion_id',$inscripcion->id_inscripcion)->first();
        $this->evaluacion_id = $evaluacion->evaluacion_id;
        $this->contarTotal($evaluacion->evaluacion_id);
        // para la evaluacion de expediente
        $this->evaluacion_expediente_titulo_model = EvaluacionExpedienteTitulo::where('tipo_evaluacion_id', $evaluacion->tipo_evaluacion_id)->get();
        $this->evaluacion_entrevista_item_model = EvaluacionEntrevistaItem::where('tipo_evaluacion_id', $evaluacion->tipo_evaluacion_id)->get();
        $this->puntaje_model = Puntaje::where('puntaje_estado', 1)->first();

        $this->expediente_model = ExpedienteInscripcion::join('expediente', 'ex_insc.expediente_cod_exp', '=', 'expediente.cod_exp')
                        ->where('ex_insc.id_inscripcion',$evaluacion->inscripcion_id)
                        ->where(function($query) use ($inscripcion){
                            $query->where('expediente.expediente_tipo', 0)
                                ->orWhere('expediente.expediente_tipo', $inscripcion->tipo_programa);
                        })
                        ->get();
    }

    public function cargarId(EvaluacionExpedienteTitulo $evaluacion_expediente_titulo)
    {
        $this->id_eva_exp = $evaluacion_expediente_titulo->evaluacion_expediente_titulo_id;

        $eva = EvaluacionExpediente::where('evaluacion_expediente_titulo_id',$this->id_eva_exp)->where('evaluacion_id',$this->evaluacion_id)->first();
        if($eva){
            $this->puntaje = number_format($eva->evaluacion_expediente_puntaje, 0);
        }
    }

    public function agregarNotaExpediente()
    {
        $evaluacion = Evaluacion::find($this->evaluacion_id);
        $eva_exp_titulo = EvaluacionExpedienteTitulo::where('tipo_evaluacion_id',$evaluacion->tipo_evaluacion_id)->get();
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

        $eva_expe = EvaluacionExpediente::where('evaluacion_id',$this->evaluacion_id)->get();
        $total = 0;
        foreach($eva_expe as $item){
            $total = $total + $item->evaluacion_expediente_puntaje;
        }
        $evaluacion->p_expediente = $total;
        $evaluacion->fecha_expediente = today();
        $evaluacion->save();

        // calcular nota final
        $puntaje_model = Puntaje::where('puntaje_estado', 1)->first();
        $evaluacion = Evaluacion::find($this->evaluacion_id);
        if($evaluacion->tipo_evaluacion_id == 1){
            $puntaje_final = $evaluacion->p_expediente + $evaluacion->p_entrevista;
            if($puntaje_final < $puntaje_model->puntaje_minimo_final_maestria){
                $evaluacion->evaluacion_observacion = 'Evaluación jalada.';
                $evaluacion->evaluacion_estado = 2;
            }else{
                $evaluacion->evaluacion_observacion = '';
                $evaluacion->evaluacion_estado = 3;
            }
        }else{
            $puntaje_final = $evaluacion->p_expediente + $evaluacion->p_investigacion + $evaluacion->p_entrevista;
            if($puntaje_final < $puntaje_model->puntaje_minimo_final_doctorado){
                $evaluacion->evaluacion_observacion = 'Evaluación jalada.';
                $evaluacion->evaluacion_estado = 2;
            }else{
                $evaluacion->evaluacion_observacion = '';
                $evaluacion->evaluacion_estado = 3;
            }
        }
        $evaluacion->p_final = $puntaje_final;
        $evaluacion->save();

        $this->contarTotal($evaluacion->evaluacion_id);
        $this->cancelar_modal_puntaje();
    }

    public function cargarIdEntrevista(EvaluacionEntrevistaItem $evaluacion_entrevista_item)
    {
        $this->evaluacion_entrevista_item_id = $evaluacion_entrevista_item->evaluacion_entrevista_item_id;
        $eval_entre_item = EvaluacionEntrevistaItem::find($this->evaluacion_entrevista_item_id);
        $eva = EvaluacionEntrevista::where('evaluacion_entrevista_item_id',$eval_entre_item->evaluacion_entrevista_item_id)->where('evaluacion_id',$this->evaluacion_id)->first();
        if($eva){
            $this->puntaje = number_format($eva->evaluacion_entrevista_puntaje, 0);
        }
    }

    public function agregarNotaEntrevista()
    {
        $evaluacion = Evaluacion::find($this->evaluacion_id);
        $eva_ent_item = EvaluacionEntrevistaItem::where('tipo_evaluacion_id',$evaluacion->tipo_evaluacion_id)->get();
        foreach($eva_ent_item as $item){
            if($item->evaluacion_entrevista_item_id == $this->evaluacion_entrevista_item_id){
                $puntaje = number_format($item->evaluacion_entrevista_item_puntaje, 0);
                $this->validate([
                    'puntaje'=> 'required|numeric|min:0|max:'.$puntaje,
                ]);
            }
        }

        $eva = EvaluacionEntrevista::where('evaluacion_entrevista_item_id',$this->evaluacion_entrevista_item_id)->where('evaluacion_id',$this->evaluacion_id)->first();

        if($eva){
            $eva->evaluacion_entrevista_puntaje = $this->puntaje;
            $eva->save();
            // $this->dispatchBrowserEvent('notificacionNota', ['message' =>'Puntaje actualizada satisfactoriamente.']);
        }else{
            $eva_expe = EvaluacionEntrevista::create([
                "evaluacion_entrevista_puntaje" => $this->puntaje,
                "evaluacion_entrevista_item_id" => $this->evaluacion_entrevista_item_id,
                "evaluacion_id" => $this->evaluacion_id,
            ]);
            // $this->dispatchBrowserEvent('notificacionNota', ['message' =>'Puntaje agregada satisfactoriamente.']);
        }

        $eva_expe = EvaluacionEntrevista::where('evaluacion_id',$this->evaluacion_id)->get();
        $total = 0;
        foreach($eva_expe as $item){
            $total = $total + $item->evaluacion_entrevista_puntaje;
        }

        $evaluacion = Evaluacion::find($this->evaluacion_id);
        $evaluacion->p_entrevista = $total;
        $evaluacion->fecha_entrevista = today();
        $evaluacion->save();

        $evaluacion = Evaluacion::find($this->evaluacion_id);
        if($total == 0){
            $evaluacion->p_entrevista = 0;
            $evaluacion->fecha_entrevista = today();
            if($evaluacion->tipo_evaluacion_id == 2){
                $evaluacion->p_investigacion = 0;
                $evaluacion->fecha_investigacion = today();
            }
            $evaluacion->evaluacion_estado = 2;
            $evaluacion->evaluacion_observacion = 'No se presentó a la evaluación de entrevista.';
            $evaluacion->save();
        }

        $evaluacion = Evaluacion::find($this->evaluacion_id);
        if($evaluacion->tipo_evaluacion_id == 1){
            $puntaje_final = $evaluacion->p_expediente + $evaluacion->p_entrevista;
            if($puntaje_final < $evaluacion->Puntaje->puntaje_minimo_final_maestria){
                $evaluacion->evaluacion_observacion = 'Evaluación jalada.';
                $evaluacion->evaluacion_estado = 2;
            }else{
                $evaluacion->evaluacion_observacion = '';
                $evaluacion->evaluacion_estado = 3;
            }
        }else{
            $puntaje_final = $evaluacion->p_expediente + $evaluacion->p_investigacion + $evaluacion->p_entrevista;
            if($puntaje_final < $evaluacion->Puntaje->puntaje_minimo_final_doctorado){
                $evaluacion->evaluacion_observacion = 'Evaluación jalada.';
                $evaluacion->evaluacion_estado = 2;
            }else{
                $evaluacion->evaluacion_observacion = '';
                $evaluacion->evaluacion_estado = 3;
            }
        }
        $evaluacion->p_final = $puntaje_final;
        $evaluacion->save();

        $this->contarTotal($evaluacion->evaluacion_id);
        $this->cancelar_modal_puntaje();
    }

    public function cancelar_modal_puntaje()
    {
        $this->reset('puntaje');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('modal_puntaje', [
            'id_inscripcion' => $this->id_inscripcion
        ]);
    }
    
    public function alerta_evaluacion_cero($id_inscripcion)
    {
        $this->dispatchBrowserEvent('alerta_evaluacion_cero', [
            'id_inscripcion' => $id_inscripcion
        ]);
    }

    public function evaluar_cero(Inscripcion $inscripcion)
    {
        $evaluacion_model = Evaluacion::where('inscripcion_id',$inscripcion->id_inscripcion)->first();
        if($evaluacion_model)
        {
            $evaluacion = Evaluacion::find($evaluacion_model->evaluacion_id);
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
    
            $evaluacion = Evaluacion::find($evaluacion_model->evaluacion_id);
            $evaluacion_expediente_titulo = EvaluacionExpedienteTitulo::where('tipo_evaluacion_id',$evaluacion->tipo_evaluacion_id)->get(); 
            foreach($evaluacion_expediente_titulo as $item){
                $evaluacion_expediente = EvaluacionExpediente::where('evaluacion_expediente_titulo_id',$item->evaluacion_expediente_titulo_id)->where('evaluacion_id',$evaluacion->evaluacion_id)->first();
                if($evaluacion_expediente){
                    $evaluacion_expediente->evaluacion_expediente_puntaje = 0;
                }else{
                    $evaluacion_expediente = new EvaluacionExpediente();
                    $evaluacion_expediente->evaluacion_expediente_puntaje = 0;
                    $evaluacion_expediente->evaluacion_expediente_titulo_id = $item->evaluacion_expediente_titulo_id;
                    $evaluacion_expediente->evaluacion_id = $evaluacion->evaluacion_id;
                }
                $evaluacion_expediente->save();
            }
    
            $evaluacion = Evaluacion::find($evaluacion_model->evaluacion_id);
            $evaluacion_entrevista_item = EvaluacionEntrevistaItem::where('tipo_evaluacion_id',$evaluacion->tipo_evaluacion_id)->get(); 
            foreach($evaluacion_entrevista_item as $item){
                $evaluacion_entrevista = EvaluacionEntrevista::where('evaluacion_entrevista_item_id',$item->evaluacion_entrevista_item_id)->where('evaluacion_id',$evaluacion->evaluacion_id)->first();
                if($evaluacion_entrevista){
                    $evaluacion_entrevista->evaluacion_entrevista_puntaje = 0;
                }else{
                    $evaluacion_entrevista = new EvaluacionEntrevista();
                    $evaluacion_entrevista->evaluacion_entrevista_puntaje = 0;
                    $evaluacion_entrevista->evaluacion_entrevista_item_id = $item->evaluacion_entrevista_item_id;
                    $evaluacion_entrevista->evaluacion_id = $evaluacion->evaluacion_id;
                }
                $evaluacion_entrevista->save();
            }
    
            if($evaluacion->tipo_evaluacion_id == 2){
                $evaluacion_investigacion_item = EvaluacionInvestigacionItem::where('evaluacion_investigacion_item_estado',1)->get(); 
                foreach($evaluacion_investigacion_item as $item){
                    $evaluacion_investigacion = EvaluacionInvestigacion::where('evaluacion_investigacion_item_id',$item->evaluacion_investigacion_item_id)->where('evaluacion_id',$evaluacion->evaluacion_id)->first();
                    if($evaluacion_investigacion){
                        $evaluacion_investigacion->evaluacion_investigacion_puntaje = 0;
                    }else{
                        $evaluacion_investigacion = new EvaluacionInvestigacion();
                        $evaluacion_investigacion->evaluacion_investigacion_puntaje = 0;
                        $evaluacion_investigacion->evaluacion_investigacion_item_id = $item->evaluacion_investigacion_item_id;
                        $evaluacion_investigacion->evaluacion_id = $evaluacion->evaluacion_id;
                    }
                    $evaluacion_investigacion->save();
                }
            }
        }
    }

    public function alerta_evaluacion_reset($id_inscripcion)
    {
        $this->dispatchBrowserEvent('alerta_evaluacion_reset', [
            'id_inscripcion' => $id_inscripcion
        ]);
    }

    public function evaluar_reset(Inscripcion $inscripcion)
    {
        $evaluacion_model = Evaluacion::where('inscripcion_id',$inscripcion->id_inscripcion)->first();
        if($evaluacion_model)
        {
            $evaluacion = Evaluacion::find($evaluacion_model->evaluacion_id);
            $evaluacion->p_expediente = null;
            $evaluacion->fecha_expediente = null;
            $evaluacion->p_entrevista = null;
            $evaluacion->fecha_entrevista = null;
            $evaluacion->p_investigacion = null;
            $evaluacion->fecha_investigacion = null;
            $evaluacion->p_final = null;
            $evaluacion->evaluacion_estado = 1;
            $evaluacion->evaluacion_observacion = null;
            $evaluacion->save();
    
            $evaluacion = Evaluacion::find($evaluacion_model->evaluacion_id);
            $evaluacion_expediente_titulo = EvaluacionExpedienteTitulo::where('tipo_evaluacion_id',$evaluacion->tipo_evaluacion_id)->get(); 
            if($evaluacion_expediente_titulo){
                foreach($evaluacion_expediente_titulo as $item){
                    $evaluacion_expediente = EvaluacionExpediente::where('evaluacion_expediente_titulo_id',$item->evaluacion_expediente_titulo_id)->where('evaluacion_id',$evaluacion->evaluacion_id)->first();
                    $evaluacion_expediente ? $evaluacion_expediente->delete() : '';
                }
            }
    
            $evaluacion = Evaluacion::find($evaluacion_model->evaluacion_id);
            $evaluacion_entrevista_item = EvaluacionEntrevistaItem::where('tipo_evaluacion_id',$evaluacion->tipo_evaluacion_id)->get(); 
            if($evaluacion_entrevista_item){
                foreach($evaluacion_entrevista_item as $item){
                    $evaluacion_entrevista = EvaluacionEntrevista::where('evaluacion_entrevista_item_id',$item->evaluacion_entrevista_item_id)->where('evaluacion_id',$evaluacion->evaluacion_id)->first();
                    $evaluacion_entrevista ? $evaluacion_entrevista->delete() : '';
                }
            }
    
            if($evaluacion->tipo_evaluacion_id == 2){
                $evaluacion_investigacion_item = EvaluacionInvestigacionItem::where('evaluacion_investigacion_item_estado',1)->get(); 
                if($evaluacion_investigacion_item){
                    foreach($evaluacion_investigacion_item as $item){
                        $evaluacion_investigacion = EvaluacionInvestigacion::where('evaluacion_investigacion_item_id',$item->evaluacion_investigacion_item_id)->where('evaluacion_id',$evaluacion->evaluacion_id)->get();
                        if($evaluacion_investigacion){
                            foreach($evaluacion_investigacion as $item){
                                $item->delete();
                            }
                        }
                    }
                }
            }
        }
    }

    public function sort($value)
    {
        if ($this->sort_nombre == $value) {
            if ($this->sort_direccion == 'asc') {
                $this->sort_direccion = 'desc';
            } else {
                $this->sort_direccion = 'asc';
            }
        } else {
            $this->sort_nombre = $value;
            $this->sort_direccion = 'asc';
        }
    }

    public function render()
    {
        if($this->filtro_programa)
        {
            $evaluaciones = Evaluacion::join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                                ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                                ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                                ->where('mencion.id_mencion',$this->filtro_programa)
                                ->where(function($query){
                                    $query->where('persona.nombres','LIKE',"%{$this->search}%")
                                        ->orWhere('persona.apell_pater','LIKE',"%{$this->search}%")
                                        ->orWhere('persona.apell_mater','LIKE',"%{$this->search}%")
                                        ->orWhere('persona.nombre_completo','LIKE',"%{$this->search}%")
                                        ->orWhere('persona.num_doc','LIKE',"%{$this->search}%")
                                        ->orWhere('inscripcion.id_inscripcion','LIKE',"%{$this->search}%");
                                })
                                // ->orderBy('inscripcion.id_inscripcion','desc')
                                ->orderBy($this->sort_nombre == 'nombre_completo' ? 'persona.' . $this->sort_nombre :'evaluacion.' .  $this->sort_nombre, $this->sort_direccion)
                                ->paginate(100);
        }
        else
        {
            $evaluaciones = Evaluacion::join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                                ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                                ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                                ->where(function($query){
                                    $query->where('persona.nombres','LIKE',"%{$this->search}%")
                                        ->orWhere('persona.apell_pater','LIKE',"%{$this->search}%")
                                        ->orWhere('persona.apell_mater','LIKE',"%{$this->search}%")
                                        ->orWhere('persona.nombre_completo','LIKE',"%{$this->search}%")
                                        ->orWhere('persona.num_doc','LIKE',"%{$this->search}%")
                                        ->orWhere('inscripcion.id_inscripcion','LIKE',"%{$this->search}%");
                                })
                                // ->orderBy('inscripcion.id_inscripcion','desc')
                                ->orderBy($this->sort_nombre == 'nombre_completo' ? 'persona.' . $this->sort_nombre :'evaluacion.' .  $this->sort_nombre, $this->sort_direccion)
                                ->paginate(100);
        }
        
        $programas = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->where('mencion.mencion_estado', 1)
                ->orderBy('programa.descripcion_programa','ASC')
                ->orderBy('subprograma.subprograma','ASC')
                ->get();

        return view('livewire.modulo-administrador.evaluacion.index', [
            'evaluaciones' => $evaluaciones,
            'programas' => $programas
        ]);
    }
}

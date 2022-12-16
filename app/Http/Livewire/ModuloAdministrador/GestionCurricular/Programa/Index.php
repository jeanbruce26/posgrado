<?php

namespace App\Http\Livewire\ModuloAdministrador\GestionCurricular\Programa;

use App\Models\Mencion;
use App\Models\Plan;
use App\Models\Programa;
use App\Models\Sede;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';
    public $titulo = 'Crear Programa de Estudios';
    public $id_plan;

    public $modo = 1;

    public $buscar_programa = 'all';
    public $buscar_plan = 'all';

    //modelos
    public $programa_model_form;
    public $subprograma_model_form;

    //form
    public $plan;
    public $sede;
    public $programa;
    
    protected $listeners = ['render', 'cambiarEstado'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'plan' => 'required|numeric',
            'sede' => 'required|numeric',
            'programa' => 'required|numeric',   
        ]);
    }

    public function modo()
    {
        $this->modo = 1;
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('plan', 'sede', 'programa');
        $this->modo = 1;
    }

    public function updatedSede($id_sede)
    {
        $this->programa_model_form = Programa::where('id_sede', $id_sede)->get();
        $this->subprograma_model_form = collect();
    }
    
    public function render()
    {
        $buscar_programa = $this->buscar_programa;
        $buscar_plan = $this->buscar_plan;
        $buscar = $this->search;

        if ($buscar_programa == 'all' && $buscar_plan == 'all') {
            $programas = Mencion::join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                ->join('facultad', 'subprograma.facultad_id', '=', 'facultad.facultad_id')
                ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                ->join('sede', 'programa.id_sede', '=', 'sede.cod_sede')
                ->join('plan', 'mencion.id_plan', '=', 'plan.id_plan')
                ->where('programa.descripcion_programa', 'LIKE', '%' . $this->search . '%')
                ->orWhere('sede.sede', 'LIKE', '%' . $this->search . '%')
                ->orWhere('subprograma.subprograma', 'LIKE', '%' . $this->search . '%')
                ->orWhere('mencion.mencion', 'LIKE', '%' . $this->search . '%')
                ->orWhere('programa.descripcion_programa', $this->buscar_programa)
                ->orWhere('mencion.id_mencion', 'LIKE', '%' . $this->search . '%')
                ->orderBy('mencion.id_mencion', 'DESC')
                ->paginate(50);
        }else if($buscar_programa != 'all' && $buscar_plan == 'all'){
            $programas = Mencion::join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                ->join('facultad', 'subprograma.facultad_id', '=', 'facultad.facultad_id')
                ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                ->join('sede', 'programa.id_sede', '=', 'sede.cod_sede')
                ->join('plan', 'mencion.id_plan', '=', 'plan.id_plan')
                ->where(function($query) use ($buscar_programa){
                    $query->where('programa.descripcion_programa',$buscar_programa);
                })
                ->where(function($query) use ($buscar){
                    $query->where('programa.descripcion_programa', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('sede.sede', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('subprograma.subprograma', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('mencion.id_mencion', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('mencion.mencion', 'LIKE', '%' . $buscar . '%');
                })
                ->orderBy('mencion.id_mencion', 'DESC')
                ->paginate(50);
        }else if ($buscar_programa == 'all' && $buscar_plan != 'all') {
            $programas = Mencion::join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                ->join('facultad', 'subprograma.facultad_id', '=', 'facultad.facultad_id')
                ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                ->join('sede', 'programa.id_sede', '=', 'sede.cod_sede')
                ->join('plan', 'mencion.id_plan', '=', 'plan.id_plan')
                ->where(function($query) use ($buscar_plan){
                    $query->where('plan.id_plan',$buscar_plan);
                })
                ->where(function($query) use ($buscar){
                    $query->where('programa.descripcion_programa', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('sede.sede', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('subprograma.subprograma', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('mencion.id_mencion', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('mencion.mencion', 'LIKE', '%' . $buscar . '%');
                })
                ->orderBy('mencion.id_mencion', 'DESC')
                ->paginate(50);
        }else if ($buscar_programa != 'all' && $buscar_plan != 'all') {
            $programas = Mencion::join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                ->join('facultad', 'subprograma.facultad_id', '=', 'facultad.facultad_id')
                ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                ->join('sede', 'programa.id_sede', '=', 'sede.cod_sede')
                ->join('plan', 'mencion.id_plan', '=', 'plan.id_plan')
                ->where(function($query) use ($buscar_programa){
                    $query->where('programa.descripcion_programa',$buscar_programa);
                })
                ->where(function($query) use ($buscar_plan){
                    $query->where('plan.id_plan',$buscar_plan);
                })
                ->where(function($query) use ($buscar){
                    $query->where('programa.descripcion_programa', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('sede.sede', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('subprograma.subprograma', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('mencion.id_mencion', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('mencion.mencion', 'LIKE', '%' . $buscar . '%');
                })
                ->orderBy('mencion.id_mencion', 'DESC')
                ->paginate(50);
        }
        
        $programa_model = Programa::groupBy('descripcion_programa')->get();
        $plan_model = Plan::where('estado',1)->groupBy('plan')->get();
        $sede_model = Sede::all();


        return view('livewire.modulo-administrador.gestion-curricular.programa.index', [
            'programas' => $programas,
            'programa_model' => $programa_model,
            'plan_model' => $plan_model,
            'sede_model' => $sede_model,
        ]);
    }
}

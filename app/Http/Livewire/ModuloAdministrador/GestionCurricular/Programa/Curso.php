<?php

namespace App\Http\Livewire\ModuloAdministrador\GestionCurricular\Programa;

use App\Models\Ciclo;
use Livewire\Component;
use App\Models\Curso as CursoModel;
use App\Models\HistorialAdministrativo;

class Curso extends Component
{
    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';
    public $titulo = 'Crear Curso';

    public $mencion_id;
    public $modo = 1;

    public $curso_id;
    public $codigo;
    public $curso;
    public $credito;
    public $horas;
    public $ciclo;
    
    protected $listeners = ['render', 'cambiarEstado'];

    public function mount($mencion_id)
    {
        $this->mencion_id = $mencion_id;
    }

    public function modo()
    {
        $this->titulo = 'Crear Curso';
        $this->modo = 1;
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->reset(['codigo', 'curso', 'credito', 'horas', 'ciclo']);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->modo = 1;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'codigo' => 'required|string',
            'curso' => 'required|string',
            'credito' => 'required|numeric',
            'horas' => 'required|numeric',
            'ciclo' => 'required|numeric',
        ]);

        if($this->credito){
            $this->horas = $this->credito * 16;
        }
    }

    public function cargarCurso(CursoModel $curso)
    {
        $this->titulo = 'Editar Curso';
        $this->modo = 2;
        $this->curso_id = $curso->curso_id;
        $this->codigo = $curso->curso_codigo;
        $this->curso = $curso->curso_nombre;
        $this->credito = $curso->curso_credito;
        $this->horas = $curso->curso_horas;
        $this->ciclo = $curso->ciclo_id;
    }

    public function cargarAlerta($id)
    {
        $this->dispatchBrowserEvent('alertaConfirmacionCurso', ['id' => $id]);
    }

    public function cambiarEstado(CursoModel $curso)
    {
        if ($curso->curso_estado == 1) {
            $curso->curso_estado = 0;
        } else {
            $curso->curso_estado = 1;
        }

        $curso->save();

        $this->subirHistorial($curso->curso_id,'Actualizacion de estado de curso','curso');
        $this->dispatchBrowserEvent('notificacionCurso', ['message' =>'Estado del curso actualizado satisfactoriamente.', 'color' => '#2eb867']);
    }

    public function guardarCurso()
    {
        if($this->modo == 1){
            $this->validate([
                'codigo' => 'required|string|unique:curso,curso_codigo',
                'curso' => 'required|string',
                'credito' => 'required|numeric',
                'horas' => 'required|numeric',
                'ciclo' => 'required|numeric',
            ]);

            $curso = new CursoModel();
            $curso->curso_codigo = $this->codigo;
            $curso->curso_nombre = $this->curso;
            $curso->curso_credito = $this->credito;
            $curso->curso_horas = $this->horas;
            $curso->curso_estado = 1;
            $curso->curso_creacion = now();
            $curso->ciclo_id = $this->ciclo;
            $curso->mencion_id = $this->mencion_id;
            $curso->save();

            $this->subirHistorial($curso->curso_id,'Creacion de curso','curso');
            $this->dispatchBrowserEvent('notificacionCurso', ['message' =>'Curso creado satisfactoriamente.', 'color' => '#2eb867']);
        }else{
            $this->validate([
                'codigo' => 'required|string|unique:curso,curso_codigo,'.$this->curso_id.',curso_id',
                'curso' => 'required|string',
                'credito' => 'required|numeric',
                'horas' => 'required|numeric',
                'ciclo' => 'required|numeric',
            ]);

            $curso = CursoModel::find($this->curso_id);
            $curso->curso_codigo = $this->codigo;
            $curso->curso_nombre = $this->curso;
            $curso->curso_credito = $this->credito;
            $curso->curso_horas = $this->horas;
            $curso->ciclo_id = $this->ciclo;
            $curso->save();

            $this->subirHistorial($curso->curso_id,'Actualizacion de curso','curso');
            $this->dispatchBrowserEvent('notificacionCurso', ['message' =>'Curso actualizado satisfactoriamente.', 'color' => '#2eb867']);
        }

        $this->limpiar();
        $this->dispatchBrowserEvent('modalCurso');
    }

    public function subirHistorial($usuario_id, $descripcion, $tabla)
    {
        HistorialAdministrativo::create([
            "usuario_id" => auth('admin')->user()->usuario_id,
            "trabajador_id" => auth('admin')->user()->TrabajadorTipoTrabajador->Trabajador->trabajador_id,
            "historial_descripcion" => $descripcion,
            "historial_tabla" => $tabla,
            "historial_usuario_id" => $usuario_id,
            "historial_fecha" => now()
        ]);
    }

    public function render()
    {
        $buscar = $this->search;
        $buscar_curso = $this->mencion_id;

        $cursos = CursoModel::where(function($query) use ($buscar_curso){
            $query->where('mencion_id',$buscar_curso);
        })
        ->where(function($query) use ($buscar){
            $query->where('curso_codigo','like','%'.$buscar.'%')
                ->orWhere('curso_nombre','like','%'.$buscar.'%');
        })
            ->get();
        $ciclo_model = Ciclo::all();

        return view('livewire.modulo-administrador.gestion-curricular.programa.curso', [
            'cursos' => $cursos,
            'ciclo_model' => $ciclo_model
        ]);
    }
}

<?php

namespace App\Http\Livewire\ModuloAdministrador\GestionCurricular\Admision;

use App\Models\Admision;
use App\Models\HistorialAdministrativo;
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
    public $titulo = 'Crear Proceso de Admision';
    public $id_admision;

    public $modo = 1;

    public $año;
    public $fecha_final;
    public $convocatoria;

    public $fecha_expediente_inicio;
    public $fecha_expediente_fin;

    public $fecha_entrevista_inicio;
    public $fecha_entrevista_fin;

    public $fecha_admitidos;

    public $fecha_constancia;

    protected $listeners = ['render', 'cambiarEstado'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'año' => 'required|numeric',
            'convocatoria' => 'nullable|string',
            'fecha_final' => 'required|date',
            'fecha_expediente_inicio' => 'required|date',
            'fecha_expediente_fin' => 'required|date',
            'fecha_entrevista_inicio' => 'required|date',
            'fecha_entrevista_fin' => 'required|date',
            'fecha_admitidos' => 'required|date',
            'fecha_constancia' => 'required|date',
        ]);
    }

    public function modo()
    {
        $this->limpiar();
        $this->modo = 1;
        $this->titulo = 'Crear Proceso de Admision';
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset([
            'año',
            'convocatoria',
            'fecha_final',
            'fecha_expediente_inicio',
            'fecha_expediente_fin',
            'fecha_entrevista_inicio',
            'fecha_entrevista_fin',
            'fecha_admitidos',
            'fecha_constancia',
        ]);
        $this->modo = 1;
    }

    public function cargarAlerta($id)
    {
        $this->dispatchBrowserEvent('alertaConfirmacionAdmision', ['id' => $id]);
    }

    public function cambiarEstado(Admision $admision)
    {
        if ($admision->estado == 1) {
            $admision->estado = 0;
        } else {
            $admision->estado = 1;
        }
        $admision->save();

        $this->subirHistorial($admision->cod_admi,'Actualizacion de estado del proceso de admision','Admision');
        $this->dispatchBrowserEvent('notificacionAdmision', ['message' =>'Estado de la admision actualizado satisfactoriamente.', 'color' => '#2eb867']);
    }

    public function cargarAdmision(Admision $admision)
    {
        $this->limpiar();
        $this->modo = 2;
        $this->titulo = 'Editar Proceso de Admision';
        $this->id_admision = $admision->cod_admi;
        $this->año = $admision->admision_year;
        $this->convocatoria = $admision->admision_convocatoria;
        $this->fecha_final = $admision->fecha_fin;
        $this->fecha_expediente_inicio = $admision->fecha_evaluacion_expediente_inicio;
        $this->fecha_expediente_fin = $admision->fecha_evaluacion_expediente_fin;
        $this->fecha_entrevista_inicio = $admision->fecha_evaluacion_entrevista_inicio;
        $this->fecha_entrevista_fin = $admision->fecha_evaluacion_entrevista_fin;
        $this->fecha_admitidos = $admision->fecha_admitidos;
        $this->fecha_constancia = $admision->fecha_constancia;
    }

    public function guardarAdmision()
    {
        if ($this->modo == 1) {
            $this->validate([
                'año' => 'required|numeric',
                'convocatoria' => 'nullable|string',
                'fecha_final' => 'required|date',
                'fecha_expediente_inicio' => 'required|date',
                'fecha_expediente_fin' => 'required|date',
                'fecha_entrevista_inicio' => 'required|date',
                'fecha_entrevista_fin' => 'required|date',
                'fecha_admitidos' => 'required|date',
                'fecha_constancia' => 'required|date',
            ]);
    
            $admision = new Admision();
            if($this->convocatoria == null){
                $admision->admision = 'ADMISION ' . $this->año;
            }else{
                $admision->admision = 'ADMISION ' . $this->año . ' - ' . $this->convocatoria;
            }
            $admision->admision_year = $this->año;
            $admision->admision_convocatoria = $this->convocatoria;
            $admision->estado = 1;
            $admision->fecha_fin = $this->fecha_final;
            $admision->fecha_evaluacion_expediente_inicio = $this->fecha_expediente_inicio;
            $admision->fecha_evaluacion_expediente_fin = $this->fecha_expediente_fin;
            $admision->fecha_evaluacion_entrevista_inicio = $this->fecha_entrevista_inicio;
            $admision->fecha_evaluacion_entrevista_fin = $this->fecha_entrevista_fin;
            $admision->fecha_admitidos = $this->fecha_admitidos;
            $admision->fecha_constancia = $this->fecha_constancia;
            $admision->save();

            $this->subirHistorial($admision->cod_admi,'Creacion de Admision','admision');
            $this->dispatchBrowserEvent('notificacionAdmision', ['message' =>'Proceso de admision agregado satisfactoriamente.', 'color' => '#2eb867']);
        }else{
            $this->validate([
                'año' => 'required|numeric',
                'convocatoria' => 'nullable|string',
                'fecha_final' => 'required|date',
                'fecha_expediente_inicio' => 'required|date',
                'fecha_expediente_fin' => 'required|date',
                'fecha_entrevista_inicio' => 'required|date',
                'fecha_entrevista_fin' => 'required|date',
                'fecha_admitidos' => 'required|date',
                'fecha_constancia' => 'required|date',
            ]);

            $admision = Admision::find($this->id_admision);
            if($this->convocatoria == null){
                $admision->admision = 'ADMISION ' . $this->año;
            }else{
                $admision->admision = 'ADMISION ' . $this->año . ' - ' . $this->convocatoria;
            }
            $admision->admision_year = $this->año;
            $admision->admision_convocatoria = $this->convocatoria;
            $admision->fecha_fin = $this->fecha_final;
            $admision->fecha_evaluacion_expediente_inicio = $this->fecha_expediente_inicio;
            $admision->fecha_evaluacion_expediente_fin = $this->fecha_expediente_fin;
            $admision->fecha_evaluacion_entrevista_inicio = $this->fecha_entrevista_inicio;
            $admision->fecha_evaluacion_entrevista_fin = $this->fecha_entrevista_fin;
            $admision->fecha_admitidos = $this->fecha_admitidos;
            $admision->fecha_constancia = $this->fecha_constancia;
            $admision->save();
            
            $this->subirHistorial($admision->cod_admi,'Actualizacion de Admision','admision');
            $this->dispatchBrowserEvent('notificacionAdmision', ['message' =>'Proceso de admision actualizado satisfactoriamente.', 'color' => '#2eb867']);
        }

        $this->dispatchBrowserEvent('modalAdmision');
        $this->limpiar();
    }

    public function subirHistorial($usuario_id, $descripcion, $tabla)
    {
        HistorialAdministrativo ::create([
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
        $admision_model = Admision::where('admision', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('admision_year', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('cod_admi', 'LIKE', '%' . $this->search . '%')
                    ->orderBy('cod_admi', 'DESC')
                    ->paginate(10);

        return view('livewire.modulo-administrador.gestion-curricular.admision.index', [
            'admision_model' => $admision_model
        ]);
    }
}

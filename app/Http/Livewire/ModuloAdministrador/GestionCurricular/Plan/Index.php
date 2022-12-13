<?php

namespace App\Http\Livewire\ModuloAdministrador\GestionCurricular\Plan;

use App\Models\HistorialAdministrativo;
use App\Models\Plan;
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
    public $titulo = 'Crear Plan de Estudios';
    public $id_plan;

    public $modo = 1;

    public $plan;

    protected $listeners = ['render', 'cambiarEstado'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'plan' => 'required|numeric'
        ]);
    }

    public function modo()
    {
        $this->modo = 1;
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('plan');
        $this->modo = 1;
    }

    public function cargarAlerta($id)
    {
        $this->dispatchBrowserEvent('alertaConfirmacionPlan', ['id' => $id]);
    }

    public function cambiarEstado(Plan $plan)
    {
        if ($plan->estado == 1) {
            $plan->estado = 0;
        } else {
            $plan->estado = 1;
        }

        $plan->save();

        $this->subirHistorial($plan->id_plan,'Actualizacion de estado de plan','Plan');
        $this->dispatchBrowserEvent('notificacionPlan', ['message' =>'Estado del plan actualizado satisfactoriamente.', 'color' => '#2eb867']);
    }

    public function cargarPlan(Plan $plan)
    {
        $this->modo = 2;
        $this->titulo = 'Editar Plan de Estudios';
        $this->id_plan = $plan->id_plan;
        $this->plan = $plan->plan;
    }

    public function guardarPlan()
    {
        if ($this->modo == 1) {
            $this->validate([
                'plan' => 'required|numeric|unique:plan,plan'
            ]);
    
            $plan = new Plan();
            $plan->plan = $this->plan;
            $plan->estado = 1;
            $plan->save();

            $this->subirHistorial($plan->id_plan,'Creacion de plan','usuario');
    
            $this->dispatchBrowserEvent('notificacionPlan', ['message' =>'Plan agregado satisfactoriamente.', 'color' => '#2eb867']);
        }else{
            $this->validate([
                'plan' => 'required|numeric|unique:plan,plan,'.$this->id_plan.',id_plan'
            ]);

            $plan = Plan::find($this->id_plan);
            $plan->plan = $this->plan;
            $plan->save();
            
            $this->subirHistorial($plan->id_plan,'Actualizacion de plan','Plan');

            $this->dispatchBrowserEvent('notificacionUsuario', ['message' =>'Plan actualizado satisfactoriamente.', 'color' => '#2eb867']);
        }

        $this->dispatchBrowserEvent('modalPlan');

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
        $plan_model = Plan::where('plan', 'LIKE', '%' . $this->search . '%')
                ->orWhere('id_plan', 'LIKE', '%' . $this->search . '%')
                ->orderBy('id_plan', 'DESC')
                ->paginate(10);

        return view('livewire.modulo-administrador.gestion-curricular.plan.index', [
            'plan_model' => $plan_model
        ]);
    }
}

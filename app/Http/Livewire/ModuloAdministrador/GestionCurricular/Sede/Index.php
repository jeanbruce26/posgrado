<?php

namespace App\Http\Livewire\ModuloAdministrador\GestionCurricular\Sede;

use App\Models\HistorialAdministrativo;
use App\Models\Sede;
use Livewire\Component;

class Index extends Component
{
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';
    public $titulo = 'Crear Sede';
    public $id_sede;

    public $modo = 1;

    public $sede;

    protected $listeners = ['render', 'cambiarEstado'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'sede' => 'required|string'
        ]);
    }

    public function modo()
    {
        $this->limpiar();
        $this->modo = 1;
        $this->titulo = 'Crear Sede';
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('sede');
        $this->modo = 1;
    }

    public function cargarAlertaEstado(Sede $sede)
    {
        if ($sede->sede_estado == 1) {
            $this->dispatchBrowserEvent('alertaEstadoSede', ['message' => '¿Está seguro de desactivar la sede ' . strtolower($sede->sede) . '?', 'color' => '#f8bb86', 'sede_id' => $sede->cod_sede]);
        } else {
            $this->dispatchBrowserEvent('alertaEstadoSede', ['message' => '¿Está seguro de activar la sede ' . strtolower($sede->sede) . '?', 'color' => '#2eb867', 'sede_id' => $sede->cod_sede]);
        }
    }

    public function cambiarEstado(Sede $sede)
    {
        if ($sede->sede_estado == 1) {
            $sede->sede_estado = 0;
            $sede->save();
            $this->subirHistorial($sede->cod_sede,'Desactivacion de sede','sede');
            $this->dispatchBrowserEvent('notificacionSede', ['message' =>'Sede desactivado satisfactoriamente.', 'color' => '#2eb867']);
        } else {
            $sede->sede_estado = 1;
            $sede->save();
            $this->subirHistorial($sede->cod_sede,'Activacion de sede','sede');
            $this->dispatchBrowserEvent('notificacionSede', ['message' =>'Sede activado satisfactoriamente.', 'color' => '#2eb867']);
        }
    }

    public function cargarSede(Sede $sede)
    {
        $this->limpiar();
        $this->id_sede = $sede->cod_sede;
        $this->sede = $sede->sede;
        $this->modo = 2;
        $this->titulo = 'Editar Sede';
    }

    public function guardarSede()
    {
        if ($this->modo == 1) {
            $this->validate([
                'sede' => 'required|string|unique:sede,sede'    
            ]);

            $sede = new Sede();
            $sede->sede = $this->sede;
            $sede->save();

            $this->subirHistorial($sede->cod_sede,'Creacion de sede','sede');
            $this->dispatchBrowserEvent('notificacionSede', ['message' =>'Sede creado satisfactoriamente.', 'color' => '#2eb867']);
        } else {
            $this->validate([
                'sede' => 'required|string|unique:sede,sede,' . $this->id_sede . ',cod_sede'
            ]);

            $sede = Sede::find($this->id_sede);
            $sede->sede = $this->sede;
            $sede->save();
            
            $this->subirHistorial($this->id_sede,'Actualizacion de sede','sede');
            $this->dispatchBrowserEvent('notificacionSede', ['message' =>'Sede actualizado satisfactoriamente.', 'color' => '#2eb867']);
        }

        $this->limpiar();
        $this->dispatchBrowserEvent('modalSede');
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
        $sede_model = Sede::where('sede', 'like', '%' . $this->search . '%')
            ->orderBy('sede', 'desc')
            ->get();

        return view('livewire.modulo-administrador.gestion-curricular.sede.index',[
            'sede_model' => $sede_model
        ]);
    }
}

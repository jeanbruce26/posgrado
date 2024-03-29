<?php

namespace App\Http\Livewire\ModuloCoordinador;

use Livewire\Component;
use App\Models\Coordinador;
use App\Models\Inscripcion;
use App\Models\Mencion;

class Index extends Component
{
    public $facultad;

    public function mostrarAlerta()
    {
        $this->dispatchBrowserEvent('errorInscripcion');
    }

    public function render()
    {
        $this->facultad = Coordinador::where('trabajador_id',auth('admin')->user()->TrabajadorTipoTrabajador->trabajador_id)->first();

        $men = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
            ->join('programa','subprograma.id_programa','=','programa.id_programa')
            ->where('subprograma.facultad_id',$this->facultad->Facultad->facultad_id)
            ->where('mencion.mencion_estado',1)
            ->get();

        return view('livewire.modulo-coordinador.index', [
            'men' => $men,
        ]);
    }
}

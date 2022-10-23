<?php

namespace App\Http\Livewire\ModuloCoordinador;

use Livewire\Component;
use App\Models\Coordinador;
use App\Models\Inscripcion;

class Index extends Component
{
    public $facultad;

    public function render()
    {
        $this->facultad = Coordinador::where('trabajador_id',auth('admin')->user()->TrabajadorTipoTrabajador->trabajador_id)->first();

        $mostrarInscripcion = Inscripcion::join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
        ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
        ->where('subprograma.facultad_id',$this->facultad->Facultad->facultad_id)->get();
        // dd($mostrarInscripcion);
        
        return view('livewire.modulo-coordinador.index', [
            'mostrarInscripcion' => $mostrarInscripcion,
        ]);
    }
}

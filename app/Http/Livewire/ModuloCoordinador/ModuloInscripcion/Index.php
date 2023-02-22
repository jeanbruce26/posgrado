<?php

namespace App\Http\Livewire\ModuloCoordinador\ModuloInscripcion;

use App\Models\Coordinador;
use App\Models\Mencion;
use Livewire\Component;

class Index extends Component
{
    public $facultad;
    
    public function render()
    {
        $this->facultad = Coordinador::where('trabajador_id',auth('admin')->user()->TrabajadorTipoTrabajador->trabajador_id)->first();

        $programas = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
            ->join('programa','subprograma.id_programa','=','programa.id_programa')
            ->where('subprograma.facultad_id',$this->facultad->Facultad->facultad_id)
            ->where('mencion.mencion_estado',1)
            ->get();

        return view('livewire.modulo-coordinador.modulo-inscripcion.index', [
            'programas' => $programas,
        ]);
    }
}

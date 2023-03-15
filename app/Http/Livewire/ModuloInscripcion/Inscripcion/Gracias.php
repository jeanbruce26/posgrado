<?php

namespace App\Http\Livewire\ModuloInscripcion\Inscripcion;

use Livewire\Component;

class Gracias extends Component
{
    public $inscripcion;

    public function mount($inscripcion)
    {
        $this->inscripcion = $inscripcion;
        if(!$this->inscripcion) {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.modulo-inscripcion.inscripcion.gracias');
    }
}

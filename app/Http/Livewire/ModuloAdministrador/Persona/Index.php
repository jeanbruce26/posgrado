<?php

namespace App\Http\Livewire\ModuloAdministrador\Persona;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // $perso = Persona::all();
        // $disca = Discapacidad::all();
        // $estCivil = EstadoCivil::all();
        // $uni = Universidad::all();
        // $gradoAca = GradoAcademico::all();
        return view('livewire.modulo-administrador.persona.index');
    }
}

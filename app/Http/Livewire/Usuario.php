<?php

namespace App\Http\Livewire;

use App\Models\Expediente;
use Livewire\Component;

class Usuario extends Component
{
    public function render()
    {
        $nombre = ucfirst(strtolower(auth('usuarios')->user()->persona->apell_pater)) . ' ' . ucfirst(strtolower(auth('usuarios')->user()->persona->apell_mater)) . ', ' . ucwords(strtolower(auth('usuarios')->user()->persona->nombres));

        return view('livewire.usuario', [
            'nombre' => $nombre,
            'expediente' => Expediente::all(),
        ]);
    }
}

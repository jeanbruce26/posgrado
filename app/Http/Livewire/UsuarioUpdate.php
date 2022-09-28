<?php

namespace App\Http\Livewire;

use App\Models\Admision;
use App\Models\Expediente;
use Livewire\Component;

class UsuarioUpdate extends Component
{
    public $expediente_update;

    public function guardar()
    {
        $this->validate([
            'expediente_update' => 'required|mimes:pdf',
        ]);
        dd($this->all());
    }   

    public function render()
    {
        $nombre = ucfirst(strtolower(auth('usuarios')->user()->persona->apell_pater)) . ' ' . ucfirst(strtolower(auth('usuarios')->user()->persona->apell_mater)) . ', ' . ucwords(strtolower(auth('usuarios')->user()->persona->nombres));

        $admision = Admision::where('estado',1)->first();
        $valor = '+ 2 day';
        $final = date('d-m-Y',strtotime($admision->fecha_fin.$valor));
        $fecha = date('d-m-Y', strtotime(today()));

        return view('livewire.usuario-update', [
            'nombre' => $nombre,
            'expediente' => Expediente::all(),
            'final' => $final,
            'fecha' => $fecha
        ]);
    }
}

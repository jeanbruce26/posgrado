<?php

namespace App\Http\Livewire\modulo_inscripcion\usuario;

use App\Models\Admision;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use Livewire\Component;

class Usuario extends Component
{
    public function render()
    {
        $nombre = ucfirst(strtolower(auth('usuarios')->user()->persona->apell_pater)) . ' ' . ucfirst(strtolower(auth('usuarios')->user()->persona->apell_mater)) . ', ' . ucwords(strtolower(auth('usuarios')->user()->persona->nombres));
        $contador = ExpedienteInscripcion::where('id_inscripcion',auth('usuarios')->user()->id_inscripcion)->count();
        setlocale( LC_ALL,"es_ES@euro","es_ES","esp" );
        $fecha_admision = strftime('%d de %B del %Y', strtotime(Admision::where('estado',1)->first()->fecha_fin));
        $fecha_admision_normal = Admision::where('estado',1)->first()->fecha_fin;
        
        return view('livewire.modulo_inscripcion.usuario.usuario', [
            'nombre' => $nombre,
            'expediente' => Expediente::all(),
            'contador' => $contador,
            'fecha_admision' => $fecha_admision,
            'fecha_admision_normal' => $fecha_admision_normal,
        ]);
    }
}

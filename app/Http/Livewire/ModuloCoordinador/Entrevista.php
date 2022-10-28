<?php

namespace App\Http\Livewire\ModuloCoordinador;

use Livewire\Component;
use App\Models\Inscripcion;
use App\Models\Evaluacion;

class Entrevista extends Component
{
    public $inscripcion_id;
    public $evaluacion_id;

    public function render()
    {
        date_default_timezone_set("America/Lima");
        $evaluacion_data = Evaluacion::find($this->evaluacion_id);
        $boton = $evaluacion_data->nota_expediente;
        $inscripcion = Inscripcion::find($evaluacion_data->inscripcion_id);
        $fecha = today();

        return view('livewire.modulo-coordinador.entrevista', [
            'inscripcion' => $inscripcion,
            'evaluacion_data' => $evaluacion_data,
            'fecha' => $fecha,
            'boton' => $boton,
        ]);
    }
}

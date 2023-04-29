<?php

namespace App\Http\Livewire\ModuloInscripcion\Usuario;

use App\Models\Inscripcion;
use App\Models\Persona;
use Livewire\Component;

class Ficha extends Component
{
    public $nombre_completo;
    public $documento_identidad;
    public $ficha_inscripcion;
    public $mostrar_ficha;

    public function buscar_ficha()
    {
        $this->mostrar_ficha = true;

        $persona = Persona::where('num_doc', $this->documento_identidad)->first();
        if (!$persona) {
            $this->mostrar_ficha = false;
            $this->dispatchBrowserEvent('alertaError', ['mensaje' => 'No se encontró a la persona con el documento de identidad ingresado.']);
            return;
        }
        $inscripcion = Inscripcion::where('persona_idpersona', $persona->idpersona)->first();
        if (!$inscripcion) {
            $this->mostrar_ficha = false;
            $this->dispatchBrowserEvent('alertaError', ['mensaje' => 'La persona no tiene una inscripción.']);
            return;
        }
        $this->ficha_inscripcion = $inscripcion->inscripcion;
        $this->nombre_completo = $persona->nombres . ' ' . $persona->apell_pater . ' ' . $persona->apell_mater;
    }

    public function limpiar()
    {
        $this->reset(['nombre_completo', 'documento_identidad', 'ficha_inscripcion', 'mostrar_ficha']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.modulo-inscripcion.usuario.ficha');
    }
}

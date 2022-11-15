<?php

namespace App\Http\Livewire\modulo_inscripcion\usuario;

use App\Models\Inscripcion;
use Livewire\Component;

class UsuarioLogin extends Component
{
    public $usuario;
    public $codigo;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'usuario' => 'required|numeric',
            'codigo' => 'required|string',
        ]);
    }

    public function login()
    {
        $data = $this->validate([
            'usuario' => 'required|numeric',
            'codigo' => 'required|string',
        ]);

        $inscripcion = Inscripcion::join('persona','persona.idpersona','=','inscripcion.persona_idpersona')->where('persona.num_doc',$this->usuario)->where('inscripcion.inscripcion_codigo',$this->codigo)->first();

        if(!$inscripcion){
            return redirect()->back()->with(array('mensaje'=>'Credenciales incorrectas'));
        }else{
            auth('usuarios')->login($inscripcion);
            return redirect()->route('usuarios.index');
        }
    }

    public function render()
    {
        return view('livewire.modulo_inscripcion.usuario.usuario-login');
    }
}

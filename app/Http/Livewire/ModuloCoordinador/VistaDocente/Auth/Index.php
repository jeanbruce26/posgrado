<?php

namespace App\Http\Livewire\ModuloCoordinador\VistaDocente\Auth;

use App\Models\UsuarioEvaluacion;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Index extends Component
{
    public $correo;
    public $password;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'correo' => 'required|email',
            'password' => 'required',
        ]);
    }

    public function login()
    {
        // dd(Hash::make($this->password));

        $data = $this->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = UsuarioEvaluacion::where('usuario_evaluacion_correo',$this->correo)->where('usuario_evaluacion_estado', 1)->first();

        if ($usuario) {
            if (Hash::check($this->password, $usuario->usuario_evaluacion_password)) {
                auth('evaluacion')->login($usuario);
                return redirect()->route('coordinador.docente.programas.index');
            } else {
                session()->flash('mensaje', 'Credenciales incorrectas');
            }
        } else {
            session()->flash('mensaje', 'Credenciales incorrectas');
        }
        
    }

    public function render()
    {
        return view('livewire.modulo-coordinador.vista-docente.auth.index');
    }
}

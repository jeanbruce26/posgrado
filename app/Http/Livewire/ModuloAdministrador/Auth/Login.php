<?php

namespace App\Http\Livewire\ModuloAdministrador\Auth;

use Livewire\Component;
use App\Models\UsuarioTrabajador;
use App\Models\TrabajadorTipoTrabajador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Login extends Component
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

        $usuario = UsuarioTrabajador::where('usuario_correo',$this->correo)->first();


        if(!$usuario){
            return redirect()->back()->with(array('mensaje'=>'Credenciales incorrectas'));
        }else{
            $usu_pass = Crypt::decryptString($usuario->usuario_contraseña);

            if($usu_pass == $this->password){
                $tra_tipo_tra = TrabajadorTipoTrabajador::where('trabajador_tipo_trabajador_id', $usuario->trabajador_tipo_trabajador_id)->first();

                // dd($tra_tipo_tra);

                if($tra_tipo_tra->tipo_trabajador_id == 4){
                    auth('admin')->login($usuario);
                    return redirect()->route('admin.index');
                }
                if($tra_tipo_tra->tipo_trabajador_id == 3){
                    // auth('admin')->login($usuario);
                    // return redirect()->route('coordinador.index');
                }
                if($tra_tipo_tra->tipo_trabajador_id == 2){
                    auth('admin')->login($usuario);
                    return redirect()->route('coordinador.index');
                }
                if($tra_tipo_tra->tipo_trabajador_id == 1){
                    // auth('admin')->login($usuario);
                    // return redirect()->route('coordinador.index');
                }
            }else{
                return redirect()->back()->with(array('mensaje'=>'Credenciales incorrectas'));
            }
        }
        
    }

    public function render()
    {
        return view('livewire.modulo-administrador.auth.login');
    }
}

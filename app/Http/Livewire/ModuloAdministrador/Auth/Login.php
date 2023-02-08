<?php

namespace App\Http\Livewire\ModuloAdministrador\Auth;

use App\Models\Administrativo;
use Livewire\Component;
use App\Models\UsuarioTrabajador;
use App\Models\TrabajadorTipoTrabajador;
use Illuminate\Support\Facades\Hash;

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
            if($usuario->usuario_estado == 0){
                return redirect()->back()->with(array('mensaje'=>'Usuario inactivo'));
            }else{
                $validar_usuario = Hash::check($this->password, $usuario->usuario_contraseña);
                if($validar_usuario){
                    if($usuario->trabajador_tipo_trabajador_id){
                        $tra_tipo_tra = TrabajadorTipoTrabajador::where('trabajador_tipo_trabajador_id', $usuario->trabajador_tipo_trabajador_id)->first();
    
                        if($tra_tipo_tra->tipo_trabajador_id == 3){
                            $administrativo = Administrativo::where('trabajador_id',$tra_tipo_tra->trabajador_id)->first();
                            if($administrativo->AreaAdministrativo->area_id == 3){
                                auth('admin')->login($usuario);
                                return redirect()->route('admin.index');
                            }else{
                                return redirect()->back()->with(array('mensaje'=>'Usuario administrativo'));
                            }
                        }
                        if($tra_tipo_tra->tipo_trabajador_id == 2){
                            auth('admin')->login($usuario);
                            return redirect()->route('coordinador.index');
                        }
                        if($tra_tipo_tra->tipo_trabajador_id == 1){
                            return redirect()->back()->with(array('mensaje'=>'Usuario docente'));
                        }
                    }else{
                        return redirect()->back()->with(array('mensaje'=>'Usuario inhabilitado'));
                    }
                }else{
                    return redirect()->back()->with(array('mensaje'=>'Credenciales incorrectas'));
                }
            }
        }
        
    }

    public function render()
    {
        return view('livewire.modulo-administrador.auth.login');
    }
}

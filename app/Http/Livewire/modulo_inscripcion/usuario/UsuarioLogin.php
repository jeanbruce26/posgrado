<?php

namespace App\Http\Livewire\modulo_inscripcion\usuario;

use App\Models\Admision;
use App\Models\Admitidos;
use App\Models\Evaluacion;
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

        $admision = Admision::where('estado',1)->first();

        if(!$inscripcion){
            return redirect()->back()->with(array('mensaje'=>'Credenciales incorrectas'));
        }else{
            if(today() < $admision->fecha_admitidos){
                auth('usuarios')->login($inscripcion);
                return redirect()->route('usuarios.index');
            }else{
                $evaluacion = Evaluacion::where('inscripcion_id',$inscripcion->id_inscripcion)->first();

                if($evaluacion){
                    $admitido_count = Admitidos::count();
                    $admitido = Admitidos::where('evaluacion_id',$evaluacion->evaluacion_id)->first();
                    if($admitido_count == 0){
                        auth('usuarios')->login($inscripcion);
                        return redirect()->route('usuarios.index');
                    }else{
                        if($admitido == null){
                            return redirect()->back()->with(array('mensaje'=>'Usuario no admitido'));
                        }else{
                            auth('usuarios')->login($inscripcion);
                            return redirect()->route('usuarios.index');
                        }
                    }
                }else{
                    auth('usuarios')->login($inscripcion);
                    return redirect()->route('usuarios.index');
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.modulo_inscripcion.usuario.usuario-login');
    }
}

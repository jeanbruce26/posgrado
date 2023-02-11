<?php

namespace App\Http\Livewire\ModuloAdministrador\Perfil;

use App\Models\TrabajadorTipoTrabajador;
use App\Models\UsuarioTrabajador;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $titulo = 'Actualizar Perfil';

    public  $trabajador_model;
    public $tipo_trabajador_model;

    //variables
    public $trabajador_id;
    public $apellido;
    public $nombre;
    public $documento;
    public $direccion;
    public $correo;
    public $grado_academico;
    public $perfil;

    public $trabajador_tipo_trabajador_id = [];
    public $username = [];
    public $correo_usuario = [];
    public $password = [];

    public $iteracion = 0;

    public $paso = 1;
    public $tamaño_paso = 2;

    public function mount()
    {
        $this->trabajador_id = auth('admin')->user()->TrabajadorTipoTrabajador->Trabajador->trabajador_id;
        $this->apellido = "";
        $this->nombre = "";
        $this->documento = "";
        $this->direccion = "";
        $this->correo = "";
        $this->grado_academico = "";
        $this->perfil = "";
        $this->paso = 1;
        $this->tamaño_paso = 2;
        $this->iteracion = 0;
        $this->trabajador_tipo_trabajador_id = TrabajadorTipoTrabajador::where('trabajador_id', $this->trabajador_id)->pluck('trabajador_tipo_trabajador_id')->toArray();
        $this->username = UsuarioTrabajador::whereIn('trabajador_tipo_trabajador_id', $this->trabajador_tipo_trabajador_id)->pluck('usuario_nombre')->toArray();
        $this->correo_usuario = UsuarioTrabajador::whereIn('trabajador_tipo_trabajador_id', $this->trabajador_tipo_trabajador_id)->pluck('usuario_correo')->toArray();
        $this->password = UsuarioTrabajador::whereIn('trabajador_tipo_trabajador_id', $this->trabajador_tipo_trabajador_id)->pluck('usuario_contraseña')->toArray();
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('apellido','nombre','documento','direccion','correo','grado_academico','username','correo_usuario','password','iteracion','perfil');
        $this->iteracion++;
        $this->paso = 1;
    }

    public function siguiente()
    {
        if($this->paso < $this->tamaño_paso){
            $this->validate([
                'apellido' => 'required',
                'nombre' => 'required',
                'documento' => 'required|numeric|unique:trabajador,trabajador_numero_documento,'.$this->trabajador_id.',trabajador_id',
                'direccion' => 'required',
                'correo' => 'required|email|unique:trabajador,trabajador_correo,'.$this->trabajador_id.',trabajador_id',
                'grado_academico' => 'required',
                'perfil' => 'nullable|image|max:2024'
            ]);
            $this->paso++;
        }else{
            $this->paso = $this->tamaño_paso;
        }
    }

    public function regresar()
    {
        if($this->paso > 1){
            $this->paso--;
        }else{
            $this->paso = 1;
        }
    }

    public function cargarTrabajador()
    {
        $this->apellido = $this->trabajador_model->trabajador_apellidos;
        $this->nombre = $this->trabajador_model->trabajador_nombres;
        $this->documento = $this->trabajador_model->trabajador_numero_documento;
        $this->direccion = $this->trabajador_model->trabajador_direccion;
        $this->correo = $this->trabajador_model->trabajador_correo;
        $this->grado_academico = $this->trabajador_model->trabajador_grado;

        // foreach($this->trabajador_tipo_trabajador_id as $trabajador_tipo_trabajador_id){
        //     $usuario_trabajador = UsuarioTrabajador::where('trabajador_tipo_trabajador_id', $trabajador_tipo_trabajador_id)->first();
        //     $this->username[$trabajador_tipo_trabajador_id] = $usuario_trabajador->usuario_nombre;
        //     $this->correo_usuario[$trabajador_tipo_trabajador_id] = $usuario_trabajador->usuario_correo;
        //     $this->password[$trabajador_tipo_trabajador_id] = "";
        // }
    }

    public function guardarPerfil()
    {
        $this->validate([
            'username.*' => 'required',
            'correo_usuario.*' => 'required|email',
            'password.*' => 'required'
        ]);

        dd($this->all());
    }

    public function render()
    {
        $this->trabajador_model = TrabajadorTipoTrabajador::where('trabajador_tipo_trabajador_id', auth('admin')->user()->trabajador_tipo_trabajador_id)
                                    ->where('trabajador_tipo_trabajador_estado', 1)
                                    ->first()
                                    ->trabajador;
                                    
        $this->tipo_trabajador_model = TrabajadorTipoTrabajador::where('trabajador_id', $this->trabajador_model->trabajador_id)->where('trabajador_tipo_trabajador_estado', 1)->get();

        // dd($this->tipo_trabajador_model);
        
        return view('livewire.modulo-administrador.perfil.index');
    }
}

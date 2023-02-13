<?php

namespace App\Http\Livewire\ModuloAdministrador\Perfil;

use App\Models\Trabajador;
use App\Models\TrabajadorTipoTrabajador;
use App\Models\UsuarioTrabajador;
use Illuminate\Support\Facades\Hash;
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

    public $trabajador_tipo_trabajador_id;
    public $tipo_trabajador_id;
    public $tipo_trabajador;
    public $username;
    public $correo_usuario;
    public $password;

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
        $this->trabajador_tipo_trabajador_id = "";
        $this->tipo_trabajador_id = "";
        $this->tipo_trabajador = "";
    }

    public function updated($propertyName)
    {
        if($this->paso == 1){
            $this->validateOnly($propertyName, [
                'apellido' => 'required',
                'nombre' => 'required',
                'documento' => 'required|numeric|unique:trabajador,trabajador_numero_documento,'.$this->trabajador_id.',trabajador_id',
                'direccion' => 'required',
                'correo' => 'required|email|unique:trabajador,trabajador_correo,'.$this->trabajador_id.',trabajador_id',
                'grado_academico' => 'required',
                'perfil' => 'nullable|image|max:2024'
            ]);
        }else if($this->paso == 2){
            $this->validateOnly($propertyName, [
                'username' => 'required|string',
                'correo_usuario' => 'required|email|unique:usuario,usuario_correo,'.auth('admin')->user()->usuario_id.',usuario_id',
                'password' => 'nullable|min:8',
            ]);
        }
    
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
            if($this->paso == 1){
                $this->validate([
                    'apellido' => 'required',
                    'nombre' => 'required',
                    'documento' => 'required|numeric|unique:trabajador,trabajador_numero_documento,'.$this->trabajador_id.',trabajador_id',
                    'direccion' => 'required',
                    'correo' => 'required|email|unique:trabajador,trabajador_correo,'.$this->trabajador_id.',trabajador_id',
                    'grado_academico' => 'required',
                    'perfil' => 'nullable|image|max:2024'
                ]);
            }
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

        $this->trabajador_tipo_trabajador_id = auth('admin')->user()->trabajador_tipo_trabajador_id;
        $this->tipo_trabajador_id = auth('admin')->user()->TrabajadorTipoTrabajador->tipo_trabajador_id;
        $this->tipo_trabajador = auth('admin')->user()->TrabajadorTipoTrabajador->TipoTrabajador->tipo_trabajador;
        $this->username = auth('admin')->user()->usuario_nombre;
        $this->correo_usuario = auth('admin')->user()->usuario_correo;
    }

    public function guardarPerfil()
    {
        $this->validate([
            'username' => 'required|string',
            'correo_usuario' => 'required|email|unique:usuario,usuario_correo,'.auth('admin')->user()->usuario_id.',usuario_id',
            'password' => 'nullable|min:8',
        ]);

        // dd($this->all());

        $usuario = UsuarioTrabajador::find(auth('admin')->user()->usuario_id);
        $usuario->usuario_nombre = $this->username;
        $usuario->usuario_correo = $this->correo_usuario;
        if($this->password != null){
            $usuario->usuario_password = Hash::make($this->password);
        }
        $usuario->save();

        $trabajador = Trabajador::find($this->trabajador_id);
        $trabajador->trabajador_apellidos = $this->apellido;
        $trabajador->trabajador_nombres = $this->nombre;
        $trabajador->trabajador_numero_documento = $this->documento;
        $trabajador->trabajador_direccion = $this->direccion;
        $trabajador->trabajador_correo = $this->correo;
        $trabajador->trabajador_grado = $this->grado_academico;
        $data = $this->perfil;
        if($data != null){
            $path =  'Perfil/';
            $filename = "perfil-".$this->trabajador_id.".".$data->extension();
            $data = $this->perfil;
            $data->storeAs($path, $filename, 'files_publico');
            $trabajador->trabajador_perfil = $path.$filename;
        }
        $trabajador->save();

        $this->limpiar();
        $this->dispatchBrowserEvent('modalPerfil');
        $this->dispatchBrowserEvent('notificacionPerfil', ['message' => 'Perfil actualizado correctamente', 'color' => '#2eb867']);
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

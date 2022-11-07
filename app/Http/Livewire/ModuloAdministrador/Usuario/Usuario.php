<?php

namespace App\Http\Livewire\ModuloAdministrador\Usuario;

use App\Models\HistorialAdministrativo;
use App\Models\UsuarioTrabajador;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithPagination;

class Usuario extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';
    public $titulo = 'Crear Usuario';
    public $usuario_id;

    public $modo = 1;

    public $username;
    public $correo;
    public $password;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'username' => 'required',
            'correo' => 'required|email',
            'password' => 'nullable'
        ]);
    }

    public function modo()
    {
        $this->modo = 1;
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('username','correo','password');
        $this->modo = 1;
    }

    public function cambiarEstado(UsuarioTrabajador $usuario)
    {
        if($usuario->usuario_estado == 1 || $usuario->usuario_estado == 2){
            $usuario->usuario_estado = 0;
        }else if($usuario->usuario_estado == 0){
            if($usuario->trabajador_tipo_trabajador_id){
                $usuario->usuario_estado = 2;
            }else{
                $usuario->usuario_estado = 1;
            }
        }

        $usuario->save();

        $this->subirHistorial($usuario->usuario_id,'Actualizacion de estado usuario','usuario');
    }

    public function cargarUsuario(UsuarioTrabajador $usuario)
    {
        $this->modo = 2;
        $this->titulo = 'ACTUALIZAR USUARIO - CORREO: '  . $usuario->correo;
        $this->usuario_id = $usuario->usuario_id;
        
        $this->username = $usuario->usuario_nombre;
        $this->correo = $usuario->usuario_correo;
    }

    public function guardarUsuario()
    {
        if ($this->modo == 1) {
            $this->validate([
                'username' => 'required|unique:usuario,usuario_nombre',
                'correo' => 'required|email|unique:usuario,usuario_correo',
                'password' => 'required'
            ]);
    
            $usuario = UsuarioTrabajador::create([
                "usuario_nombre" => $this->username,
                "usuario_correo" => $this->correo,
                "usuario_contraseña" => Crypt::encryptString($this->password),
                "usuario_estado" => 1,
            ]);

            $this->subirHistorial($usuario->usuario_id,'Creacion de usuario','usuario');
    
            $this->dispatchBrowserEvent('notificacionUsuario', ['message' =>'Usuario agregado satisfactoriamente.', 'color' => '#2eb867']);
        }else{
            $this->validate([
                'username' => "required|unique:usuario,usuario_nombre,{$this->usuario_id},usuario_id",
                'correo' => "required|email|unique:usuario,usuario_correo,{$this->usuario_id},usuario_id",
                'password' => 'nullable'
            ]);

            $usuario = UsuarioTrabajador::find($this->usuario_id);
            $usuario->usuario_nombre = $this->username;
            $usuario->usuario_correo = $this->correo;
            if($this->password){
                $usuario->usuario_contraseña = Crypt::encryptString($this->password);
            }
            $usuario->save();
            
            $this->subirHistorial($usuario->usuario_id,'Actualizacion de usuario','usuario');

            $this->dispatchBrowserEvent('notificacionUsuario', ['message' =>'Usuario '.$this->username.' actualizado satisfactoriamente.', 'color' => '#2eb867']);
        }

        $this->dispatchBrowserEvent('modalUsuario');

        $this->limpiar();
    }

    public function subirHistorial($usuario_id, $descripcion, $tabla)
    {
        date_default_timezone_set("America/Lima");

        HistorialAdministrativo::create([
            "usuario_id" => auth('admin')->user()->usuario_id,
            "trabajador_id" => auth('admin')->user()->TrabajadorTipoTrabajador->Trabajador->trabajador_id,
            "historial_descripcion" => $descripcion,
            "historial_tabla" => $tabla,
            "historial_usuario_id" => $usuario_id,
            "historial_fecha" => now()
        ]);
    }


    public function render()
    {
        $usuarios = UsuarioTrabajador::where(function($query) {$query->where('usuario_id','!=',1);})
                ->where(function($query) {
                    $query->where('usuario_nombre','LIKE',"%{$this->search}%")
                    ->orWhere('usuario_correo','LIKE',"%{$this->search}%")
                    ->orWhere('usuario_id','LIKE',"%{$this->search}%");
                    })
                ->orderBy('usuario_id','DESC')
                ->paginate(50);

        return view('livewire.modulo-administrador.usuario.usuario', [
            'usuarios' => $usuarios
        ]);
    }
}

<?php

namespace App\Http\Livewire\ModuloAdministrador\Usuario;

use Livewire\Component;
use App\Models\Facultad;
use App\Models\Trabajador;
use App\Models\TrabajadorTipoTrabajador;
use App\Models\UsuarioTrabajador;
use App\Models\Coordinador as CoordinadorModel;
use App\Models\TipoDocumento;
use Illuminate\Support\Facades\Hash;

class Coordinador extends Component
{
    public $tipo_documento;
    public $documento;
    public $nombres;
    public $apellidos;
    public $direccion;
    public $correo;
    public $grado;
    public $categoria;
    public $facultad;
    public $username;
    public $password;
    public $tipo_trabajador = 2;

    public $tipo_documento_update;
    public $documento_update;
    public $nombres_update;
    public $apellidos_update;
    public $direccion_update;
    public $correo_update;
    public $grado_update;
    public $categoria_update;
    public $facultad_update;
    public $username_update;
    public $password_update;

    public $facultad_antiguo;

    public $traba_id;

    public $modo = 1;

    protected $listeners = ['render', 'deleteCoordinador'];

    public function updated($propertyName)
    {
        if($this->modo == 1){
            if($this->tipo_documento == 1){
                $this->validateOnly($propertyName, [
                    'tipo_documento' => 'required|numeric',
                    'documento' => 'required|digits:8',
                    'nombres' => 'required|string',
                    'apellidos' => 'required|string',
                    'direccion' => 'required|string',
                    'correo' => 'required|email',
                    'grado' => 'required|string',
                    'categoria' => 'required|string',
                    'facultad' => 'required|numeric',
                    'username' => 'required|string',
                    'password' => 'required',
                ]);
            }else{
                $this->validateOnly($propertyName, [
                    'tipo_documento' => 'required|numeric',
                    'documento' => 'required|digits:9',
                    'nombres' => 'required|string',
                    'apellidos' => 'required|string',
                    'direccion' => 'required|string',
                    'correo' => 'required|email',
                    'grado' => 'required|string',
                    'categoria' => 'required|string',
                    'facultad' => 'required|numeric',
                    'username' => 'required|string',
                    'password' => 'required',
                ]);
            }
        }
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('tipo_documento', 
            'documento',
            'nombres',
            'apellidos',
            'direccion',
            'correo',
            'grado',
            'categoria',
            'facultad',
            'username',
            'password',
            'tipo_documento_update', 
            'documento_update',
            'nombres_update',
            'apellidos_update',
            'direccion_update',
            'correo_update',
            'grado_update',
            'categoria_update',
            'facultad_update',
            'username_update',
            'password_update'
        );
        $this->modo = 1;
    }

    public function modo()
    {
        $this->modo = 1;
    }

    public function crear()
    {
        if($this->tipo_documento == 1){
            $this->validate([
                'tipo_documento' => 'required|numeric',
                'documento' => 'required|digits:8|numeric',
                'nombres' => 'required|string',
                'apellidos' => 'required|string',
                'direccion' => 'required|string',
                'correo' => 'required|email',
                'grado' => 'required|string',
                'categoria' => 'required|string',
                'facultad' => 'required|numeric',
                'username' => 'required|string',
                'password' => 'required',
            ]);
        }else{
            $this->validate([
                'tipo_documento' => 'required|numeric',
                'documento' => 'required|digits:9|numeric',
                'nombres' => 'required|string',
                'apellidos' => 'required|string',
                'direccion' => 'required|string',
                'correo' => 'required|email',
                'grado' => 'required|string',
                'categoria' => 'required|string',
                'facultad' => 'required|numeric',
                'username' => 'required|string',
                'password' => 'required',
            ]);
        }

        $trabajador = Trabajador::create([
            "trabajador_nombres" => $this->nombres,
            "trabajador_apellidos" => $this->apellidos,
            "trabajador_numero_documento" => $this->documento,
            "trabajador_correo" => $this->correo,
            "trabajador_direccion" => $this->direccion,
            "trabajador_grado" => $this->grado,
        ]);

        $trabajador_id = $trabajador->trabajador_id;

        $coordinador = CoordinadorModel::create([
            "trabajador_id" => $trabajador_id,
            "facultad_id" => $this->facultad,
            "categoria_docente" => $this->categoria,
        ]);

        $trabajador_tipo_trabajador = TrabajadorTipoTrabajador::create([
            "trabajador_id" => $trabajador_id,
            "tipo_trabajador_id" => $this->tipo_trabajador,
        ]);

        $trabajador_tipo_trabajador_id = $trabajador_tipo_trabajador->trabajador_tipo_trabajador_id;

        $usuario = UsuarioTrabajador::create([
            "usuario_nombre" => $this->username,
            "usuario_contraseña" => Hash::make($this->password),
            "trabajador_tipo_trabajador_id" => $trabajador_tipo_trabajador_id,
        ]);

        $facu = Facultad::find($this->facultad);
        $facu->facultad_estado = 2;
        $facu->save();

        session()->flash('message', 'Coordinador creado satisfactoriamente.');

        $this->dispatchBrowserEvent('modalCrear');

        $this->limpiar();

        return redirect()->route('admin.coordinador.index');
    }

    public function cargarTrabajador($id)
    {
        $this->modo = 2;

        $this->traba_id = $id;

        $tra = TrabajadorTipoTrabajador::find($this->traba_id);

        if(strlen($tra->Trabajador->trabajador_numero_documento) == 8){
            $this->tipo_documento_update = 1;
        }else{
            $this->tipo_documento_update = 2;
        }
        $this->documento_update = $tra->Trabajador->trabajador_numero_documento;
        $this->nombres_update = $tra->Trabajador->trabajador_nombres;
        $this->apellidos_update = $tra->Trabajador->trabajador_apellidos;
        $this->correo_update = $tra->Trabajador->trabajador_correo;
        $this->direccion_update = $tra->Trabajador->trabajador_direccion;
        $this->grado_update = $tra->Trabajador->trabajador_grado;

        $cor = CoordinadorModel::where('trabajador_id', $tra->trabajador_id)->first();
        
        $this->facultad_update = $cor->facultad_id;
        $this->facultad_antiguo =  $cor->facultad_id;
        $this->categoria_update = $cor->categoria_docente;
        
        $use = UsuarioTrabajador::where('trabajador_tipo_trabajador_id', $id)->first();
        
        $this->username_update = $use->usuario_nombre;
        $this->password_update = "";
    }

    public function actualizar()
    {
        // dd($this->all());

        if($this->tipo_documento_update == 1){
            $this->validate([
                'tipo_documento_update' => 'required|numeric',
                'documento_update' => 'required|digits:8|numeric',
                'nombres_update' => 'required|string',
                'apellidos_update' => 'required|string',
                'direccion_update' => 'required|string',
                'correo_update' => 'required|email',
                'grado_update' => 'required|string',
                'categoria_update' => 'required|string',
                'facultad_update' => 'required|numeric',
                'username_update' => 'required|string',
                'password_update' => 'nullable',
            ]);
        }else{
            $this->validate([
                'tipo_documento_update' => 'required|numeric',
                'documento_update' => 'required|digits:9|numeric',
                'nombres_update' => 'required|string',
                'apellidos_update' => 'required|string',
                'direccion_update' => 'required|string',
                'correo_update' => 'required|email',
                'grado_update' => 'required|string',
                'categoria_update' => 'required|string',
                'facultad_update' => 'required|numeric',
                'username_update' => 'required|string',
                'password_update' => 'nullable',
            ]);
        }

        $tra = TrabajadorTipoTrabajador::find($this->traba_id);

        $trabajador = Trabajador::find($tra->trabajador_id);
        $trabajador->trabajador_nombres = $this->nombres_update;
        $trabajador->trabajador_apellidos = $this->apellidos_update;
        $trabajador->trabajador_numero_documento = $this->documento_update;
        $trabajador->trabajador_correo = $this->correo_update;
        $trabajador->trabajador_direccion = $this->direccion_update;
        $trabajador->trabajador_grado = $this->grado_update;
        $trabajador->save();

        $coordinador = CoordinadorModel::where('trabajador_id', $tra->trabajador_id)->first();
        $coordinador->trabajador_id = $tra->trabajador_id;
        $coordinador->facultad_id = $this->facultad_update;
        $coordinador->categoria_docente = $this->categoria_update;
        $coordinador->save();

        $usuario = UsuarioTrabajador::where('trabajador_tipo_trabajador_id', $this->traba_id)->first();
        $usuario->usuario_nombre = $this->username_update;
        if($this->password_update){
            $usuario->usuario_contraseña = Hash::make($this->password_update);
        }
        $usuario->save();

        $facu = Facultad::find($this->facultad_antiguo);
        $facu->facultad_estado = 1;
        $facu->save();

        $facu = Facultad::find($this->facultad_update);
        $facu->facultad_estado = 2;
        $facu->save();
        
        session()->flash('message', 'Coordinador actualizado satisfactoriamente.');

        $this->dispatchBrowserEvent('modalActualizar', ['id' => $this->traba_id]);

        $this->limpiar();

        return redirect()->route('admin.coordinador.index');
    }

    public function eliminar($id)
    {
        $this->dispatchBrowserEvent('delete', ['id' => $id]);
    }

    public function deleteCoordinador(TrabajadorTipoTrabajador $id)
    {
        $id_tra = $id->trabajador_id;
        $coordinador = CoordinadorModel::where('trabajador_id', $id->trabajador_id)->first();
        $facu = Facultad::find($coordinador->facultad_id);
        $facu->facultad_estado = 1;
        $facu->save();
        $coordinador->delete();
        $usuario = UsuarioTrabajador::where('trabajador_tipo_trabajador_id', $id->trabajador_tipo_trabajador_id)->first()->delete();
        $id->delete();
        $trabajador = Trabajador::find($id_tra)->delete();

        session()->flash('message', 'Coordinador eliminado satisfactoriamente.');
    }

    public function render()
    {
        return view('livewire.modulo-administrador.usuario.coordinador',[
            'facu' => Facultad::where('facultad_estado',1)->get(),
            'facu2' => Facultad::all(),
            'tipo_doc' => TipoDocumento::all(),
            'mostrar_coordinador' => TrabajadorTipoTrabajador::where('tipo_trabajador_id',$this->tipo_trabajador)->get(),
        ]);
    }
}

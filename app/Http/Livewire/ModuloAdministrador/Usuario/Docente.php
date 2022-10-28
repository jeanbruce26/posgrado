<?php

namespace App\Http\Livewire\ModuloAdministrador\Usuario;

use Livewire\Component;
use App\Models\Trabajador;
use App\Models\TrabajadorTipoTrabajador;
use App\Models\UsuarioTrabajador;
use App\Models\TipoDocumento;
use App\Models\Docente as DocenteModel;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithFileUploads;


class Docente extends Component
{
    use WithFileUploads;

    public $tipo_documento;
    public $documento;
    public $nombres;
    public $apellidos;
    public $direccion;
    public $correo;
    public $grado;
    public $cv;
    public $tipo_docente;
    public $username;
    public $password;
    public $tipo_trabajador = 1;

    public $tipo_documento_update;
    public $documento_update;
    public $nombres_update;
    public $apellidos_update;
    public $direccion_update;
    public $correo_update;
    public $grado_update;
    public $cv_update;
    public $tipo_docente_update;
    public $username_update;
    public $password_update;

    public $modo = 1;

    public $trabajaTipo; //Trabajador Tipo Trabajador

    protected $listeners = ['render', 'deleteDocente'];

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
                    'cv' => 'nullable|file|mimes:pdf|max:10024',
                    'tipo_docente' => 'required|string',
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
                    'cv' => 'nullable|file|mimes:pdf|max:10024',
                    'tipo_docente' => 'required|string',
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
            'cv',
            'tipo_docente',
            'username',
            'password',
            'tipo_documento_update', 
            'documento_update',
            'nombres_update',
            'apellidos_update',
            'direccion_update',
            'correo_update',
            'grado_update',
            'cv_update',
            'tipo_docente_update',
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
            if ($this->tipo_docente == 2) {
                # code...
            }

            $this->validate([
                'tipo_documento' => 'required|numeric',
                'documento' => 'required|digits:8|numeric',
                'nombres' => 'required|string',
                'apellidos' => 'required|string',
                'direccion' => 'required|string',
                'correo' => 'required|email',
                'grado' => 'required|string',
                'cv' => 'required|file|mimes:pdf|max:10024',
                'tipo_docente' => 'required|string',
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
                'cv' => 'required|file|mimes:pdf|max:10024',
                'tipo_docente' => 'required|string',
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

        $docente = DocenteModel::create([
            "trabajador_id" => $trabajador_id,
            "docente_tipo_docente" => $this->tipo_docente,

        ]);

        $trabajador_tipo_trabajador = TrabajadorTipoTrabajador::create([
            "trabajador_id" => $trabajador_id,
            "tipo_trabajador_id" => $this->tipo_trabajador,
        ]);

        $trabajador_tipo_trabajador_id = $trabajador_tipo_trabajador->trabajador_tipo_trabajador_id;

        $usuario = UsuarioTrabajador::create([
            "usuario_nombre" => $this->username,
            "usuario_correo" => $this->correo,
            "usuario_contraseña" => Crypt::encryptString($this->password),
            "trabajador_tipo_trabajador_id" => $trabajador_tipo_trabajador_id,
        ]);

        $data = $this->cv;
            
        if($data != null){
            $path =  'Docente/' .$docente->docente_id. '/';
            $filename = "cv.".$data->extension();
            $data = $this->cv;
            $data->storeAs($path, $filename, 'files_publico');

            $doc = DocenteModel::find($docente->docente_id);
            $doc->docente_cv = $filename;
            $doc->save();
        }

        session()->flash('message', 'Docente creado satisfactoriamente.');

        $this->dispatchBrowserEvent('modalCrear');

        $this->limpiar();

        return redirect()->route('admin.docente.index');
    }

    public function cargarDocente($id)
    {
        $this->modo = 2;

        $this->trabajaTipo = $id;

        $tra = TrabajadorTipoTrabajador::find($this->trabajaTipo);

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

        $doc = DocenteModel::where('trabajador_id', $tra->trabajador_id)->first();

        // $this
        $this->tipo_docente_update = $doc->docente_tipo_docente;

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
                'tipo_docente_update' => 'required|string',
                'cv_update' => 'nullable|file|mimes:pdf|max:10024',
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
                'tipo_docente_update' => 'required|string',
                'cv_update' => 'nullable|file|mimes:pdf|max:10024',
                'username_update' => 'required|string',
                'password_update' => 'nullable',
            ]);
        }

        $tra = TrabajadorTipoTrabajador::find($this->trabajaTipo);

        $trabajador = Trabajador::find($tra->trabajador_id);
        $trabajador->trabajador_nombres = $this->nombres_update;
        $trabajador->trabajador_apellidos = $this->apellidos_update;
        $trabajador->trabajador_numero_documento = $this->documento_update;
        $trabajador->trabajador_correo = $this->correo_update;
        $trabajador->trabajador_direccion = $this->direccion_update;
        $trabajador->trabajador_grado = $this->grado_update;
        $trabajador->save();

        $docente = DocenteModel::where('trabajador_id', $tra->trabajador_id)->first();
        $docente->trabajador_id = $tra->trabajador_id;
        $docente->docente_tipo_docente = $this->tipo_docente_update;
        $docente->save();

        $data = $this->cv_update;
        if($data != null){
            $path =  'Docente/' .$docente->docente_id. '/';
            $filename = "cv.".$data->extension();
            $data = $this->cv_update;
            $data->storeAs($path, $filename, 'files_publico');

            $doc = DocenteModel::find($docente->docente_id);
            $doc->docente_cv = $filename;
            $doc->save();
        }

        $usuario = UsuarioTrabajador::where('trabajador_tipo_trabajador_id', $this->trabajaTipo)->first();
        $usuario->usuario_nombre = $this->username_update;
        $usuario->usuario_correo = $this->correo_update;
        if($this->password_update){
            $usuario->usuario_contraseña = Crypt::encryptString($this->password_update);
        }
        $usuario->save();
        
        session()->flash('message', 'Docente actualizado satisfactoriamente.');

        $this->dispatchBrowserEvent('modalActualizar', ['id' => $this->trabajaTipo]);

        $this->limpiar();

        return redirect()->route('admin.docente.index');
    }

    public function eliminar($id)
    {
        $this->dispatchBrowserEvent('delete', ['id' => $id]);
    }

    public function deleteDocente(TrabajadorTipoTrabajador $id)
    {
        // $id_tra = $id->trabajador_id;
        // $docente = DocenteModel::where('trabajador_id', $id->trabajador_id)->first()->delete();;
        // $usuario = UsuarioTrabajador::where('trabajador_tipo_trabajador_id', $id->trabajador_tipo_trabajador_id)->first()->delete();
        // $id->delete();
        // $trabajador = Trabajador::find($id_tra)->delete();

        session()->flash('message', 'Usuario de Docente desactivado satisfactoriamente.');
    }

    public function render()
    {
        return view('livewire.modulo-administrador.usuario.docente',[
            'tipo_doc' => TipoDocumento::all(),
            'mostrar_docente' => TrabajadorTipoTrabajador::where('tipo_trabajador_id',$this->tipo_trabajador)->get(),
        ]);
    }
}

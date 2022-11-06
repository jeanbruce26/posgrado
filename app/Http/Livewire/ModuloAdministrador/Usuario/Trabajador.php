<?php

namespace App\Http\Livewire\ModuloAdministrador\Usuario;

use App\Models\Administrativo;
use App\Models\AreaAdministrativo;
use App\Models\Coordinador;
use App\Models\Docente;
use App\Models\Facultad;
use Livewire\Component;
use App\Models\TipoDocumento;
use App\Models\TipoTrabajador;
use App\Models\Trabajador as TrabajadorModel;
use App\Models\TrabajadorTipoTrabajador;
use App\Models\UsuarioTrabajador;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Trabajador extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => ''],
        'mostrar' => ['except' => '10']
    ];

    public $search = '';
    public $mostrar = 10;
    public $tipo = 'all';
    public $titulo_modal = 'Crear Trabajador';

    public $tipo_documento;
    public $documento;
    public $nombres;
    public $apellidos;
    public $direccion;
    public $correo;
    public $grado;
    public $perfil;
    
    public $trabajador_id;

    public $modo = 1;

    public $docente;
    public $coordinador;
    public $administrativo;

    public $tipo_docente = 0;
    public $tipo_coordinador = 0;
    public $tipo_administrativo = 0;

    //DOCENTE
    public $tipo_docentes;
    public $cv;

    //COORDINADOR
    public $facultad;
    public $facultad_antiguo;
    public $facultad_model = null;
    public $usuario_model = null;
    public $usuario;
    public $usuario_antiguo;
    public $categoria;

    //ADMINISTRATIVO
    public $area_model;
    public $area;

    //TRABAJADOR TIPO TRABAJADOR
    public $trabajador_tipo_trabajador;
    public $trabajador_model;
    public $docente_model;
    public $coordinador_model;
    public $administrativo_model;
    public $user_model;


    public function updated($propertyName)
    {
        if($this->modo == 3){
            if($this->docente == true){
                $this->tipo_docente = 1;
            }else{
                $this->tipo_docente = 0;
            }
    
            if($this->coordinador == true){
                $this->validateOnly($propertyName, [
                    'categoria' => 'nullable|string',
                    'facultad' => 'required|numeric',
                    'usuario' => 'required|string',
                ]);
                $this->tipo_coordinador = 1;
                $this->facultad_model = Facultad::all();
                $this->usuario_model = UsuarioTrabajador::all();
            }else{
                $this->tipo_coordinador = 0;
            }
    
            if($this->administrativo == true){
                $this->tipo_administrativo = 1;
                $this->area_model = AreaAdministrativo::all();
                $this->usuario_model = UsuarioTrabajador::all();
            }else{
                $this->tipo_administrativo = 0;
            }
        }else{
            if($this->tipo_documento == 2){
                $this->validateOnly($propertyName, [
                    'tipo_documento' => 'required|numeric',
                    'documento' => 'required|digits:9',
                    'nombres' => 'required|string',
                    'apellidos' => 'required|string',
                    'direccion' => 'required|string',
                    'correo' => 'required|email',
                    'grado' => 'required|string',
                    'perfil' => 'nullable|file|mimes:jpg,png,jpeg',
                ]);
            }else{
                $this->validateOnly($propertyName, [
                    'tipo_documento' => 'required|numeric',
                    'documento' => 'required|digits:8',
                    'nombres' => 'required|string',
                    'apellidos' => 'required|string',
                    'direccion' => 'required|string',
                    'correo' => 'required|email',
                    'grado' => 'required|string',
                    'perfil' => 'nullable|file|mimes:jpg,png,jpeg',
                ]);
            }
        }
    }

    public function modo()
    {
        $this->modo = 1;
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('tipo_documento','documento','nombres','apellidos','direccion','correo','grado','perfil');
        $this->modo = 1;
    }

    public function cambiarEstado(TrabajadorModel $trabajador)
    {
        $trabajador_tipo_trabajador = TrabajadorTipoTrabajador::where('trabajador_id',$trabajador->trabajador_id)->first();
        if($trabajador_tipo_trabajador){

        }else{
            if($trabajador->trabajador_estado == 1){
                $trabajador->trabajador_estado = 2;
            }else{
                $trabajador->trabajador_estado = 1;
            }
        }
        $trabajador->save();
    }

    public function cargarTrabajador(TrabajadorModel $trabajador)
    {
        $this->modo = 2;
        $this->titulo_modal = 'Actualizar Trabajador - ' . $trabajador->trabajador_apellidos . ', '  . $trabajador->trabajador_nombres;
        $this->trabajador_id = $trabajador->trabajador_id;
        
        if(strlen($trabajador->trabajador_numero_documento) == 8){
            $this->tipo_documento = 1;
        }else{
            $this->tipo_documento = 2;
        }
        $this->documento = $trabajador->trabajador_numero_documento;
        $this->nombres = $trabajador->trabajador_nombres;
        $this->apellidos = $trabajador->trabajador_apellidos;
        $this->direccion = $trabajador->trabajador_direccion;
        $this->correo = $trabajador->trabajador_correo;
        $this->grado = $trabajador->trabajador_grado;
    }

    public function guardarTrabajador()
    {
        $id_trabajador = 0;

        if ($this->modo == 1) {
            if($this->tipo_documento == 1){
                $this->validate([
                    'tipo_documento' => 'required|numeric',
                    'documento' => 'required|digits:8|numeric|unique:trabajador,trabajador_numero_documento',
                    'nombres' => 'required|string',
                    'apellidos' => 'required|string',
                    'direccion' => 'required|string',
                    'correo' => 'required|email',
                    'grado' => 'required|string',
                    'perfil' => 'nullable|file|mimes:jpg,png,jpeg',
                ]);
            }else{
                $this->validate([
                    'tipo_documento' => 'required|numeric',
                    'documento' => 'required|digits:9|numeric|unique:trabajador,trabajador_numero_documento',
                    'nombres' => 'required|string',
                    'apellidos' => 'required|string',
                    'direccion' => 'required|string',
                    'correo' => 'required|email',
                    'grado' => 'required|string',
                    'perfil' => 'nullable|file|mimes:jpg,png,jpeg',
                ]);
            }
    
            $trabajador = TrabajadorModel::create([
                "trabajador_nombres" => $this->nombres,
                "trabajador_apellidos" => $this->apellidos,
                "trabajador_numero_documento" => $this->documento,
                "trabajador_correo" => $this->correo,
                "trabajador_direccion" => $this->direccion,
                "trabajador_grado" => $this->grado,
                "trabajador_estado" => 1,
            ]);

            $id_trabajador = $trabajador->trabajador_id;
    
            $this->dispatchBrowserEvent('notificacionTrabajador', ['message' =>'Trabajador agregado satisfactoriamente.']);
        }else{
            if($this->tipo_documento == 1){
                $this->validate([
                    'tipo_documento' => 'required|numeric',
                    'documento' => "required|digits:8|numeric|unique:trabajador,trabajador_numero_documento,{$this->trabajador_id},trabajador_id",
                    'nombres' => 'required|string',
                    'apellidos' => 'required|string',
                    'direccion' => 'required|string',
                    'correo' => 'required|email',
                    'grado' => 'required|string',
                    'perfil' => 'nullable|file|mimes:jpg,png,jpeg',
                ]);
            }else{
                $this->validate([
                    'tipo_documento' => 'required|numeric',
                    'documento' => "required|digits:9|numeric|unique:trabajador,trabajador_numero_documento,{$this->trabajador_id},trabajador_id",
                    'nombres' => 'required|string',
                    'apellidos' => 'required|string',
                    'direccion' => 'required|string',
                    'correo' => 'required|email',
                    'grado' => 'required|string',
                    'perfil' => 'nullable|file|mimes:jpg,png,jpeg',
                ]);
            }

            $trabajador = TrabajadorModel::find($this->trabajador_id);
            $trabajador->trabajador_numero_documento = $this->documento;
            $trabajador->trabajador_apellidos = $this->apellidos;
            $trabajador->trabajador_nombres = $this->nombres;
            $trabajador->trabajador_direccion = $this->direccion;
            $trabajador->trabajador_correo = $this->correo;
            $trabajador->trabajador_grado = $this->grado;
            $trabajador->save();

            $id_trabajador = $this->trabajador_id;

            $this->dispatchBrowserEvent('notificacionTrabajador', ['message' =>'Trabajador '.$this->nombres.' actualizado satisfactoriamente.']);
        }

        $data = $this->perfil;
        if($data != null){
            $path =  'Perfil/';
            $filename = "perfil-".$id_trabajador.".".$data->extension();
            $data = $this->perfil;
            $data->storeAs($path, $filename, 'files_publico');

            $tra = TrabajadorModel::find($id_trabajador);
            $tra->trabajador_perfil = $filename;
            $tra->save();
        }

        $this->dispatchBrowserEvent('modalTrabajador');

        $this->limpiar();
    }

    public function cargarTrabajadorId(TrabajadorModel $trabajador)
    {
        $this->modo = 3;
        $this->titulo_modal = 'Asignar Trabajador';
        $this->trabajador_id = $trabajador->trabajador_id;

        $trabajador_tipo_trabajador = TrabajadorTipoTrabajador::where('trabajador_id',$this->trabajador_id)->first();
        if($trabajador_tipo_trabajador){
            if($trabajador_tipo_trabajador->tipo_trabajador_id == 1){ //docente
                dd($trabajador_tipo_trabajador);
            }
            if($trabajador_tipo_trabajador->tipo_trabajador_id == 2){ //coordinador
                $this->coordinador = true;
                $this->tipo_coordinador = 1;

                $coordinador_model = Coordinador::where('trabajador_id',$this->trabajador_id)->first();
                $this->facultad_model = Facultad::all();
                $this->facultad = $coordinador_model->facultad_id;
                $this->facultad_antiguo = $coordinador_model->facultad_id; //para cambiar el estado cuando se actualiza los datos del trabajador
                $this->categoria = $coordinador_model->categoria_docente;

                $this->usuario_model = UsuarioTrabajador::all();
                $usuario_model = UsuarioTrabajador::where('trabajador_tipo_trabajador_id',$trabajador_tipo_trabajador->trabajador_tipo_trabajador_id)->first();
                $this->usuario = $usuario_model->usuario_correo;
                $this->usuario_antiguo = $usuario_model->usuario_id; //para cambiar el estado cuando se actualiza los datos del trabajador
            }
            if($trabajador_tipo_trabajador->tipo_trabajador_id == 3){ //administrativo
                dd($trabajador_tipo_trabajador);
            }
        }
    }

    public function limpiarDocente()
    {
        $this->resetErrorBag();
        $this->reset('tipo_docentes','cv');
        $this->docente = false;
        $this->tipo_docente = 0;
    }

    public function limpiarCoordinador()
    {
        $this->resetErrorBag();
        $this->reset('facultad','categoria','usuario');
        $this->coordinador = false;
        $this->tipo_coordinador = 0;
    }

    public function limpiarAdministrativo()
    {
        $this->resetErrorBag();
        $this->reset('area','usuario');
        $this->administrativo = false;
        $this->tipo_administrativo = 0;
    }

    public function limpiarAsignacion()
    {
        $this->limpiarDocente();
        $this->limpiarCoordinador();
        $this->limpiarAdministrativo();
    }

    public function asignarTrabajador()
    {
        $trabajador_tipo_trabajador = TrabajadorTipoTrabajador::where('trabajador_id',$this->trabajador_id)->first();
        if($trabajador_tipo_trabajador){ //ACTUALIZAR TRABAJADOR ASIGNADO
            if($this->docente == true){
                // dd($this->all());
            }
    
            if($this->coordinador == true){
                $this->validate([
                    'categoria' => 'nullable|string',
                    'facultad' => 'required|numeric',
                    'usuario' => 'required|string',
                ]);

                $coordinador = Coordinador::where('trabajador_id', $this->trabajador_id)->first();
                $coordinador->facultad_id = $this->facultad;
                $coordinador->categoria_docente = $this->categoria;
                $coordinador->save();

                //cambiar el estado del usuario antiguo
                $usuario = UsuarioTrabajador::find($this->usuario_antiguo);
                $usuario->trabajador_tipo_trabajador_id = null;
                $usuario->usuario_estado = 1;
                $usuario->save();

                $usuario_id = UsuarioTrabajador::where('usuario_correo',$this->usuario)->first()->usuario_id;

                //cambiar el estado del nuevo usuario seleccionado
                $usuario = UsuarioTrabajador::find($usuario_id);
                $usuario->trabajador_tipo_trabajador_id = $trabajador_tipo_trabajador->trabajador_tipo_trabajador_id;
                $usuario->usuario_estado = 2;
                $usuario->save();

                //cambiar el estado de la facultad antiguo
                $facu = Facultad::find($this->facultad_antiguo);
                $facu->facultad_estado = 1;
                $facu->save();

                //cambiar el estado de la nueva facultad seleccionada
                $facu = Facultad::find($this->facultad);
                $facu->facultad_estado = 2;
                $facu->save();
            }
    
            if($this->administrativo == true){
                // dd($this->all());
            }

            $this->dispatchBrowserEvent('notificacionAsignar', ['message' =>'Trabajador asignado actualizado satisfactoriamente.']);
        }else{ //CREAR ASIGNACION DEL TRABAJADOR
            if($this->docente == true){
                // dd($this->all());
            }
    
            if($this->coordinador == true){
                $this->validate([
                    'categoria' => 'nullable|string',
                    'facultad' => 'required|numeric',
                    'usuario' => 'required|string',
                ]);

                $coordinador = Coordinador::create([
                    "trabajador_id" => $this->trabajador_id,
                    "facultad_id" => $this->facultad,
                    "categoria_docente" => $this->categoria,
                    "coordinador_estado" => 1,
                ]);

                $trabajador_tipo_trabajador_create = TrabajadorTipoTrabajador::create([
                    "trabajador_id" => $this->trabajador_id,
                    "tipo_trabajador_id" => 2,
                    "trabajador_tipo_trabajador_estado" => 1,
                ]);

                $usuario_id = UsuarioTrabajador::where('usuario_correo',$this->usuario)->first()->usuario_id;

                $usuario = UsuarioTrabajador::find($usuario_id);
                $usuario->trabajador_tipo_trabajador_id = $trabajador_tipo_trabajador_create->trabajador_tipo_trabajador_id;
                $usuario->usuario_estado = 2;
                $usuario->save();

                $facu = Facultad::find($this->facultad);
                $facu->facultad_estado = 2;
                $facu->save();
            }
    
            if($this->administrativo == true){
                // dd($this->all());
            }

            $this->dispatchBrowserEvent('notificacionAsignar', ['message' =>'Trabajador asignado satisfactoriamente.']);
        }
        
        $this->dispatchBrowserEvent('modalAsignar');
        $this->limpiarAsignacion();
    }

    public function cargarInfoTrabajador(TrabajadorModel $trabajador)
    {
        $this->modo = 4;
        $this->titulo_modal = 'Informacion del Trabajador';
        $this->trabajador_id = $trabajador->trabajador_id;

        $this->trabajador_tipo_trabajador = TrabajadorTipoTrabajador::where('trabajador_id',$this->trabajador_id)->first();
        $this->trabajador_model = $trabajador;
        $this->docente_model = Docente::where('trabajador_id',$this->trabajador_id)->first();
        $this->coordinador_model = Coordinador::where('trabajador_id',$this->trabajador_id)->first();
        $this->administrativo_model = Administrativo::where('trabajador_id',$this->trabajador_id)->first();
        if($this->trabajador_tipo_trabajador){
            $this->user_model = UsuarioTrabajador::where('trabajador_tipo_trabajador_id',$this->trabajador_tipo_trabajador->trabajador_tipo_trabajador_id)->get();
        }
    }
    
    public function render()
    {
        $tip = $this->tipo;
        $buscar = $this->search;

        if($this->tipo == 'all'){
            $trabajadores = TrabajadorModel::where('trabajador_nombres','LIKE',"%{$this->search}%")
                    ->orWhere('trabajador_apellidos','LIKE',"%{$this->search}%")
                    ->orWhere('trabajador_grado','LIKE',"%{$this->search}%")
                    ->orderBy('trabajador_id','DESC')
                    ->paginate($this->mostrar);
        }else{
            $trabajadores = TrabajadorTipoTrabajador::join('trabajador','trabajador_tipo_trabajador.trabajador_id','=','trabajador.trabajador_id')
                ->where(function($query) use ($tip){$query->where('trabajador_tipo_trabajador.tipo_trabajador_id',$tip);})
                ->where(function($query) use ($buscar){
                    $query->where('trabajador.trabajador_nombres','LIKE',"%{$buscar}%")
                        ->orWhere('trabajador.trabajador_apellidos','LIKE',"%{$buscar}%")
                        ->orWhere('trabajador.trabajador_grado','LIKE',"%{$buscar}%");
                    })
                ->orderBy('trabajador_tipo_trabajador_id','DESC')
                ->paginate($this->mostrar);
        }

        $tipo_trabajadores = TipoTrabajador::where('tipo_trabajador_id','!=','4')->get();

        return view('livewire.modulo-administrador.usuario.trabajador', [
            'tipo_doc' => TipoDocumento::all(),
            'trabajadores' => $trabajadores,
            'tipo_trabajadores' => $tipo_trabajadores,
        ]);
    }
}

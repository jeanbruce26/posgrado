<?php

namespace App\Http\Livewire\ModuloAdministrador\Usuario;

use Livewire\Component;
use App\Models\TipoDocumento;
use App\Models\TipoTrabajador;
use App\Models\Trabajador as TrabajadorModel;
use App\Models\TrabajadorTipoTrabajador;
use Livewire\WithPagination;

class Trabajador extends Component
{
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
    
    public $trabajador_id;

    public $modo = 1;

    public function updated($propertyName)
    {
        if($this->tipo_documento == 2){
            $this->validateOnly($propertyName, [
                'tipo_documento' => 'required|numeric',
                'documento' => 'required|digits:9|unique:trabajador,trabajador_numero_documento',
                'nombres' => 'required|string',
                'apellidos' => 'required|string',
                'direccion' => 'required|string',
                'correo' => 'required|email',
                'grado' => 'required|string',
            ]);
        }else{
            $this->validateOnly($propertyName, [
                'tipo_documento' => 'required|numeric',
                'documento' => 'required|digits:8|unique:trabajador,trabajador_numero_documento',
                'nombres' => 'required|string',
                'apellidos' => 'required|string',
                'direccion' => 'required|string',
                'correo' => 'required|email',
                'grado' => 'required|string',
            ]);
        }
    }

    public function modo()
    {
        $this->modo = 1;
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('tipo_documento','documento','nombres','apellidos','direccion','correo','grado');
        $this->modo = 1;
    }

    public function cambiarEstado(TrabajadorModel $trabajador)
    {
        if($trabajador->trabajador_estado == 1){
            $trabajador->trabajador_estado = 2;
        }else{
            $trabajador->trabajador_estado = 1;
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
                ]);
            }
    
            TrabajadorModel::create([
                "trabajador_nombres" => $this->nombres,
                "trabajador_apellidos" => $this->apellidos,
                "trabajador_numero_documento" => $this->documento,
                "trabajador_correo" => $this->correo,
                "trabajador_direccion" => $this->direccion,
                "trabajador_grado" => $this->grado,
                "trabajador_estado" => 1,
            ]);
    
            $this->dispatchBrowserEvent('notificacionTrabajador', ['message' =>'Trabajador agregado satisfactoriamente.']);
        }else{
            $trabajador = TrabajadorModel::find($this->trabajador_id);
            $trabajador->trabajador_numero_documento = $this->documento;
            $trabajador->trabajador_apellidos = $this->apellidos;
            $trabajador->trabajador_nombres = $this->nombres;
            $trabajador->trabajador_direccion = $this->direccion;
            $trabajador->trabajador_correo = $this->correo;
            $trabajador->trabajador_grado = $this->grado;
            $trabajador->save();

            $this->dispatchBrowserEvent('notificacionTrabajador', ['message' =>'Trabajador '.$this->nombres.' actualizado satisfactoriamente.']);
        }

        $this->dispatchBrowserEvent('modalTrabajador');

        $this->limpiar();
    }
    
    public function render()
    {
        $tip = $this->tipo;
        $buscar = $this->search;

        if($this->tipo == 'all'){
            $trabajadores = TrabajadorModel::where('trabajador_nombres','LIKE',"%{$this->search}%")
                    ->orWhere('trabajador_apellidos','LIKE',"%{$this->search}%")
                    ->orWhere('trabajador_grado','LIKE',"%{$this->search}%")
                    ->paginate($this->mostrar);
        }else{
            $trabajadores = TrabajadorTipoTrabajador::join('trabajador','trabajador_tipo_trabajador.trabajador_id','=','trabajador.trabajador_id')
                ->where(function($query) use ($tip){$query->where('trabajador_tipo_trabajador.tipo_trabajador_id',$tip);})
                ->where(function($query) use ($buscar){
                    $query->where('trabajador.trabajador_nombres','LIKE',"%{$buscar}%")
                        ->orWhere('trabajador.trabajador_apellidos','LIKE',"%{$buscar}%")
                        ->orWhere('trabajador.trabajador_grado','LIKE',"%{$buscar}%");
                    })
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

<?php

namespace App\Http\Livewire;

use App\Models\Admision;
use App\Models\Departamento;
use App\Models\Discapacidad;
use App\Models\Distrito;
use App\Models\EstadoCivil;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use App\Models\GradoAcademico;
use App\Models\Inscripcion;
use App\Models\Mencion;
use App\Models\Persona;
use App\Models\Programa;
use App\Models\Provincia;
use App\Models\Sede;
use App\Models\SubPrograma;
use App\Models\UbigeoPersona;
use App\Models\Universidad;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $departamento_direccion;
    public $departamento_direccion_array;
    public $provincia_direccion;
    public $provincia_direccion_array;
    public $distrito_direccion;
    public $distrito_direccion_array;
    public $departamento_nacimiento;
    public $departamento_nacimiento_array;
    public $provincia_nacimiento;
    public $provincia_nacimiento_array;
    public $distrito_nacimiento;
    public $distrito_nacimiento_array;
    public $sede_combo;
    public $sede_combo_array;
    public $programa_combo;
    public $programa_nombre;
    public $programa_combo_array;
    public $subprograma_combo;
    public $subprograma_combo_array;
    public $mencion_combo;
    public $mencion_combo_array;
    public $id_inscripcion;
    public $apellido_paterno;
    public $apellido_materno;
    public $nombres;
    public $fecha_nacimiento;
    public $genero;
    public $estado_civil;
    public $grado_academico;
    public $especialidad;
    public $discapacidad;
    public $direccion;
    public $celular;
    public $celular_opcional;
    public $año_egreso;
    public $correo;
    public $correo_opcional;
    public $universidad;
    public $trabajo;
    // public $expediente = [];
    public $expediente1;
    public $expediente2;
    public $expediente3;
    public $expediente4;
    public $expediente5;
    public $expediente6;
    public $expediente_id = [];
    public $totalpasos = 2;
    public $pasoactual = 0;
    public $check = false;

    // protected $listeners = ['inscripcion'];
    
    public function mount($id){
        $this->id_inscripcion = $id;
        $this->pasoactual = 1;
        $this->departamento_direccion_array = Departamento::all();
        $this->provincia_direccion_array = collect();
        $this->distrito_direccion_array = collect();
        $this->departamento_nacimiento_array = Departamento::all();
        $this->provincia_nacimiento_array = collect();
        $this->distrito_nacimiento_array = collect();
        $this->sede_combo_array = Sede::all();
        $this->programa_combo_array = collect();
        $this->subprograma_combo_array = collect();
        $this->mencion_combo_array = collect();
        // $this->expediente_id = Expediente::where('estado',1)->get();
    }

    public function disminuirPaso(){
        // $this->resetErrorBag();     
        $this->pasoactual--;
        if($this->pasoactual <= 1){
            $this->pasoactual = 1;
        }
    }

    public function aumentarPaso(){  
        $this->resetErrorBag();
        $this->validacion();            
        $this->pasoactual++;
        if($this->pasoactual >= $this->totalpasos){
            $this->pasoactual = $this->totalpasos;
        }
    }

    public function validacion(){
        if($this->pasoactual == 1){
            $this->validate([
                'apellido_paterno' => 'required|string',
                'apellido_materno' => 'required|string',
                'nombres' => 'required|string',
                'fecha_nacimiento' => 'required|date',    
                'genero' => 'required|string',
                'estado_civil' => 'required|numeric',
                'grado_academico' => 'required|numeric',
                'discapacidad' => 'nullable|numeric',
                'especialidad' => 'nullable|string',
                'direccion' => 'required|string',
                'celular' => 'required|numeric|digits:9',
                'celular_opcional' => 'nullable|numeric|digits:9',
                'correo' => 'required|email',
                'correo_opcional' => 'nullable|email',
                'año_egreso' => 'required|integer',
                'departamento_direccion' => 'required|numeric',
                'provincia_direccion' => 'required|numeric',
                'distrito_direccion' => 'required|numeric',
                'departamento_nacimiento' => 'required|numeric',
                'provincia_nacimiento' => 'required|numeric',
                'distrito_nacimiento' => 'required|numeric',
                'universidad' => 'required|numeric',
                'trabajo' => 'required|string',
            ]);
        }
    }

    public function updated()
    {

    }
    
    public function updatedDepartamentoDireccion($departamento_direccion){
        $this->provincia_direccion_array = Provincia::where('id_departamento',$departamento_direccion)->get();
        $this->distrito_direccion = null;
    }
    
    public function updatedProvinciaDireccion($provincia_direccion){
        $this->distrito_direccion_array = Distrito::where('id_provincia',$provincia_direccion)->get();
    }

    public function updatedDepartamentoNacimiento($departamento_nacimiento){
        $this->provincia_nacimiento_array = Provincia::where('id_departamento',$departamento_nacimiento)->get();
        $this->distrito_nacimiento = null;
    }
    
    public function updatedProvinciaNacimiento($provincia_nacimiento){
        $this->distrito_nacimiento_array = Distrito::where('id_provincia',$provincia_nacimiento)->get();
    }

    public function updatedSedeCombo($sede_combo){
        $this->programa_combo_array = Programa::where('id_sede',$sede_combo)->get();
        $this->subprograma_combo_array = collect();
        $this->mencion_combo_array = collect();
    }

    public function updatedProgramaCombo($programa_combo){
        $this->subprograma_combo_array = SubPrograma::where('id_programa',$programa_combo)->get();
        $this->programa_nombre = Programa::where('id_programa',$programa_combo)->first();
        $this->mencion_combo_array = collect();
    }

    public function updatedSubProgramaCombo($subprograma_combo){
        $this->mencion_combo_array = Mencion::where('id_subprograma',$subprograma_combo)->get();
        $valor = null;
        foreach($this->mencion_combo_array as $item){
            $valor = $item->mencion;
        }
        if($valor == null){
            $mencion = Mencion::where('id_subprograma',$subprograma_combo)->first();
            $this->mencion_combo = $mencion->id_mencion;
        }
    }

    public function inscripcion()
    {
        // dd($this->all());
        $this->resetErrorBag();
        if($this->pasoactual == 2){
            $this->validate([
                'sede_combo' => 'required|numeric',
                'programa_combo' => 'required|numeric',
                'subprograma_combo' => 'required|numeric',
                'mencion_combo' => 'required|numeric',
                'check' => 'accepted',
            ]);
            
        }

        //FORMULARIO 1

        $persona = Persona::create([
            "num_doc" => auth('pagos')->user()->dni,
            "apell_pater" => $this->apellido_paterno,
            "apell_mater" =>$this->apellido_materno,
            "nombres" => $this->nombres,
            "direccion" => $this->direccion,
            "celular1" => $this->celular,
            "celular2" => $this->celular_opcional,
            "sexo" => $this->genero,
            "fecha_naci" => $this->fecha_nacimiento,
            "email" => $this->correo,
            "email2" => $this->correo_opcional,
            "año_egreso" => $this->año_egreso,
            "centro_trab" => $this->trabajo,
            "discapacidad_cod_disc" => $this->discapacidad,
            "est_civil_cod_est" => $this->estado_civil,
            "univer_cod_uni" => $this->universidad,
            "id_grado_academico" => $this->grado_academico,
            "especialidad" => $this->especialidad
        ]);

        $idpersona = $persona->idpersona;

        $input = $this->all();

        // dd($input);
        
        $ubigeo_distrito = Distrito::select('ubigeo')->where('id',$this->distrito_direccion)->first();
        UbigeoPersona::create([
            "id_distrito" => $this->distrito_direccion,
            "tipo_ubigeo_cod_tipo" => 1,
            "persona_idpersona" => $idpersona,
            "ubigeo" => $ubigeo_distrito->ubigeo,
        ]);

        $ubigeo_nacimiento = Distrito::select('ubigeo')->where('id',$this->distrito_nacimiento)->first();
        UbigeoPersona::create([
            "id_distrito" => $this->distrito_nacimiento,
            "tipo_ubigeo_cod_tipo" => 1,
            "persona_idpersona" => $idpersona,
            "ubigeo" => $ubigeo_nacimiento->ubigeo,
        ]);

        $inscripcion = Inscripcion::find($this->id_inscripcion);
        $inscripcion->persona_idpersona = $idpersona;
        $inscripcion->id_mencion = $this->mencion_combo;
        $inscripcion->save();

        $estadoExpediente = "Enviado";

        $count = Expediente::count();

        for($i = 1; $i <= $count; $i++){
            $expe = Expediente::where('cod_exp',$i)->get();
            foreach($expe as $item){
                $nombreExpediente = $item->tipo_doc;
                $cod = $item->cod_exp;
            }

            $admision3 = Admision::where('estado',1)->first();
            $admi = $admision3->admision;

            $name = 'expediente'.$cod;

            $data = $this->$name;
            
            if($data != null){
                $path = $admi. '/' .$this->id_inscripcion. '/';
                $filename = $nombreExpediente.".".$data->extension();
                $data = $this->$name;
                $data->storeAs($path, $filename, 'imagen_publico');

                ExpedienteInscripcion::create([
                    "nom_exped" => $filename,
                    "estado" => $estadoExpediente,
                    "expediente_cod_exp" => $i,
                    "id_inscripcion" => $this->id_inscripcion,
                ]);
            }
        }
        
        return redirect()->route('usuario-pdf', $this->id_inscripcion);
    }

    public function render()
    {
        $est_civil = EstadoCivil::all();
        $tipo_dis = Discapacidad::all();
        $uni = Universidad::all();
        $grad = GradoAcademico::all();
        $expe = Expediente::where('estado',1)->get();

        return view('livewire.create',[
            'est' => $est_civil,
            'tipo_dis' => $tipo_dis,
            'uni' => $uni,
            'grad' => $grad,
            'expe' => $expe
        ]);
    }
}

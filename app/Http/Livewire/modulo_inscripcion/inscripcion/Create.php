<?php

namespace App\Http\Livewire\modulo_inscripcion\inscripcion;

use App\Models\Admision;
use App\Models\Departamento;
use App\Models\Discapacidad;
use App\Models\Distrito;
use App\Models\EstadoCivil;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use App\Models\GradoAcademico;
use App\Models\HistorialInscripcion;
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
    public $pais;
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
    public $opcion = 0;
    public $iteration;

    // protected $listeners = ['inscripcion'];
    
    public function mount($id){
        $this->id_inscripcion = $id;
        $this->pasoactual = 1;

        $dni = auth('pagos')->user()->dni;
        $persona_buscar = Persona::where('num_doc',$dni)->count();
        // dd($persona_buscar);
        if($persona_buscar==0){
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
        }else{
            $persona_buscar_datos = Persona::where('num_doc',$dni)->first();
            $this->apellido_paterno = $persona_buscar_datos->apell_pater;
            $this->apellido_materno = $persona_buscar_datos->apell_mater;
            $this->nombres = $persona_buscar_datos->nombres;
            $this->fecha_nacimiento = date('Y-m-d', strtotime($persona_buscar_datos->fecha_naci));
            $this->genero = $persona_buscar_datos->sexo;
            $this->estado_civil = $persona_buscar_datos->est_civil_cod_est;
            $this->grado_academico = $persona_buscar_datos->id_grado_academico;
            $this->especialidad = $persona_buscar_datos->especialidad;
            $this->discapacidad = $persona_buscar_datos->discapacidad_cod_disc;
            $this->direccion = $persona_buscar_datos->direccion;
            $this->celular = $persona_buscar_datos->celular1;
            $this->celular_opcional = $persona_buscar_datos->celular2;
            $this->año_egreso = $persona_buscar_datos->año_egreso;
            $this->correo = $persona_buscar_datos->email;
            $this->correo_opcional = $persona_buscar_datos->email2;
            $this->reset('universidad');
            $this->universidad = $persona_buscar_datos->univer_cod_uni;
            $this->trabajo = $persona_buscar_datos->centro_trab;
            $this->pais = $persona_buscar_datos->pais_extra;
            $ubi_dire = UbigeoPersona::where('persona_idpersona',$persona_buscar_datos->idpersona)->where('tipo_ubigeo_cod_tipo',1)->first();
            $id_distrito_dire = $ubi_dire->id_distrito;
            $pro = Distrito::where('id',$id_distrito_dire)->first();
            $id_provincia_dire = $pro->id_provincia;
            $dep = Provincia::where('id',$id_provincia_dire)->first();
            $id_departamento_dire = $dep->id_departamento;
            $ubi_naci = UbigeoPersona::where('persona_idpersona',$persona_buscar_datos->idpersona)->where('tipo_ubigeo_cod_tipo',2)->first();
            $id_distrito_naci = $ubi_naci->id_distrito;
            $pro_naci = Distrito::where('id',$id_distrito_naci)->first();
            $id_provincia_naci = $pro_naci->id_provincia;
            $dep_naci = Provincia::where('id',$id_provincia_naci)->first();
            $id_departamento_naci = $dep_naci->id_departamento;
            $this->departamento_direccion_array = Departamento::all();
            $this->departamento_direccion = $id_departamento_dire;
            $this->provincia_direccion_array = collect();
            $this->distrito_direccion_array = collect();
            $this->provincia_direccion = $id_provincia_dire;
            $this->provincia_direccion_array = Provincia::where('id_departamento', $id_departamento_dire)->get();
            $this->distrito_direccion = $id_distrito_dire;
            $this->distrito_direccion_array = Distrito::where('id_provincia', $id_provincia_dire)->get();
            $this->departamento_nacimiento_array = Departamento::all();
            $this->departamento_nacimiento = $id_departamento_naci;
            $this->provincia_nacimiento_array = collect();
            $this->distrito_nacimiento_array = collect();
            $this->provincia_nacimiento = $id_provincia_naci;
            $this->provincia_nacimiento_array = Provincia::where('id_departamento', $id_departamento_naci)->get();
            $this->distrito_nacimiento = $id_distrito_naci;
            $this->distrito_nacimiento_array = Distrito::where('id_provincia', $id_provincia_naci)->get();
            $this->sede_combo_array = Sede::all();
            $this->programa_combo_array = collect();
            $this->subprograma_combo_array = collect();
            $this->mencion_combo_array = collect();
        }
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

    public function validarUltimoPaso(){  
        $this->resetErrorBag();
        $this->validacion();
        $this->dispatchBrowserEvent('abrir-modal');
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
                'pais' => 'nullable|string',
            ]);
            // dd($this->all());
        }else if($this->pasoactual == 2){
            $this->validate([
                'sede_combo' => 'required|numeric',
                'programa_combo' => 'required|numeric',
                'subprograma_combo' => 'required|numeric',
                'mencion_combo' => 'required|numeric',
                'check' => 'accepted',
            ]);
            $expe = Expediente::where('estado',1)->get();
            foreach($expe as $item){
                $nombre = 'expediente'.$item->cod_exp;
                if($item->requerido == 1){
                    $this->validate([
                        $nombre => 'required|mimes:pdf|max:10024',
                    ]);
                }else{
                    $this->validate([
                        $nombre => 'nullable|mimes:pdf|max:10024',
                    ]);
                }
            }
        }
    }
    
    public function updatedDepartamentoDireccion($departamento_direccion){
        $this->provincia_direccion_array = Provincia::where('id_departamento',$departamento_direccion)->get();
        $this->distrito_direccion = null;
        $this->distrito_direccion_array = collect();
    }
    
    public function updatedProvinciaDireccion($provincia_direccion){
        $this->distrito_direccion_array = Distrito::where('id_provincia',$provincia_direccion)->get();
    }

    public function updatedDepartamentoNacimiento($departamento_nacimiento){
        $this->provincia_nacimiento_array = Provincia::where('id_departamento',$departamento_nacimiento)->get();
        $this->distrito_nacimiento = null;
        $this->distrito_nacimiento_array = collect();
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
        $this->subprograma_combo_array = SubPrograma::where('id_programa',$programa_combo)->where('estado',1)->get();
        $this->programa_nombre = Programa::where('id_programa',$programa_combo)->first();
        $this->mencion_combo_array = collect();
    }

    public function updatedSubProgramaCombo($subprograma_combo){
        $this->mencion_combo_array = Mencion::where('id_subprograma',$subprograma_combo)->where('mencion_estado',1)->get();
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
        $this->resetErrorBag();

        //FORMULARIO 1

        $dni = auth('pagos')->user()->dni;
        $persona_buscar = Persona::where('num_doc',$dni)->count();
        $idpersona = null;
        if ($this->distrito_nacimiento){
            if ($this->distrito_nacimiento != 1893){
                $pais = 'Perú';
            }else
            {
                $pais = $this->pais;
            }
        }

        if($persona_buscar==0){
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
                "especialidad" => $this->especialidad,
                "pais_extra" => $pais,
            ]);
    
            $idpersona = $persona->idpersona;
    
            $input = $this->all();
            
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
                "tipo_ubigeo_cod_tipo" => 2,
                "persona_idpersona" => $idpersona,
                "ubigeo" => $ubigeo_nacimiento->ubigeo,
            ]);
        }else{
            $persona_buscar_datos = Persona::where('num_doc',$dni)->first();
            $idpersona = $persona_buscar_datos->idpersona;
            $persona_datos = Persona::find($idpersona);
            $persona_datos->update([
                'apell_pater' => $this->apellido_paterno,
                'apell_mater' => $this->apellido_materno,
                'nombres' => $this->nombres,
                'direccion' => $this->direccion,
                'celular1' => $this->celular,
                'celular2' => $this->celular_opcional,
                'sexo' => $this->genero,
                'fecha_naci' => $this->fecha_nacimiento,
                'email' => $this->correo,
                'email2' => $this->correo_opcional,
                'año_egreso' => $this->año_egreso,
                'centro_trab' => $this->trabajo,
                'discapacidad_cod_disc' => $this->discapacidad,
                'est_civil_cod_est' => $this->estado_civil,
                'univer_cod_uni' => $this->universidad,
                'id_grado_academico' => $this->grado_academico,
                'especialidad' => $this->especialidad,
                'pais_extra' => $pais,
            ]);

            $ubigeo_distrito = Distrito::select('ubigeo')->where('id',$this->distrito_direccion)->first();
            $ubigeo_direccion = UbigeoPersona::where('tipo_ubigeo_cod_tipo',1)->where('persona_idpersona',$idpersona)->first();
            $ubigeo_direccion->update([
                'id_distrito' => $this->distrito_direccion,
                'ubigeo' => $ubigeo_distrito->ubigeo,
            ]);

            $ubigeo_nacimiento = Distrito::select('ubigeo')->where('id',$this->distrito_nacimiento)->first();
            $ubigeo_nacimiento_persona = UbigeoPersona::where('tipo_ubigeo_cod_tipo',2)->where('persona_idpersona',$idpersona)->first();
            $ubigeo_nacimiento_persona->update([
                'id_distrito' => $this->distrito_nacimiento,
                'ubigeo' => $ubigeo_nacimiento->ubigeo,
            ]);
        }

        $inscripcion = Inscripcion::find($this->id_inscripcion);
        $inscripcion->persona_idpersona = $idpersona;
        $inscripcion->id_mencion = $this->mencion_combo;
        $inscripcion->fecha_inscripcion = now();
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
                $data->storeAs($path, $filename, 'files_publico');

                ExpedienteInscripcion::create([
                    "nom_exped" => $filename,
                    "estado" => $estadoExpediente,
                    "expediente_cod_exp" => $i,
                    "id_inscripcion" => $this->id_inscripcion,
                ]);
            }
        }

        $historial_inscripcion = new HistorialInscripcion();
        $historial_inscripcion->persona_documento = auth('pagos')->user()->dni;
        $historial_inscripcion->id_inscripcion = $this->id_inscripcion;
        $historial_inscripcion->admision = $admision3->admision;
        $historial_inscripcion->programa = $this->mencion_combo;
        $historial_inscripcion->historial_inscripcion_fecha = now();
        $historial_inscripcion->admitido = 0;
        $historial_inscripcion->save();
        
        return redirect()->route('usuario-pdf', $this->id_inscripcion);
    }

    public function render()
    {
        $est_civil = EstadoCivil::all();
        $tipo_dis = Discapacidad::all();
        $uni = Universidad::all();
        $grad = GradoAcademico::all();
        $expe = Expediente::where('estado',1)->get();

        return view('livewire.modulo_inscripcion.inscripcion.create',[
            'est' => $est_civil,
            'tipo_dis' => $tipo_dis,
            'uni' => $uni,
            'grad' => $grad,
            'expe' => $expe
        ]);
    }
}

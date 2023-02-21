<?php

namespace App\Http\Livewire\modulo_inscripcion\inscripcion;

use App\Models\Admision;
use App\Models\Departamento;
use App\Models\Discapacidad;
use App\Models\Distrito;
use App\Models\EstadoCivil;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use App\Models\ExpedienteInscripcionSeguimiento;
use App\Models\ExpedienteTipoSeguimiento;
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
use Illuminate\Support\Facades\File;
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
    public $id_persona;
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
    public $expediente;
    public $totalpasos = 2;
    public $pasoactual = 0;
    public $check = false;
    public $opcion = 0;
    public $iteration;

    public $expe;
    public $mostrar_tipo_expediente; // sirve para mostrar los expedientes segun el programa que elija el usuario
    public $modo = 1; // 1 = crear, 2 = editar
    public $expediente_nombre = '';
    public $expediente_cod_exp;
    public $expediente_requerido;

    public $check_expediente = false;   // sirve para hacer el seguimiento de los expedientes de grado academico
                                        // true = acepta la declaracion jurada, false = no acepta la declaracion jurada

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
            $this->sede_combo_array = Sede::where('sede_estado',1)->get();
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
            $this->sede_combo_array = Sede::where('sede_estado',1)->get();
            $this->programa_combo_array = collect();
            $this->subprograma_combo_array = collect();
            $this->mencion_combo_array = collect();
        }
    }

    public function updated($propertyName)
    {
        if($this->pasoactual == 1){
            $this->validateOnly($propertyName, [
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
        }else if($this->pasoactual == 2){
            $this->validateOnly($propertyName, [
                'sede_combo' => 'required|numeric',
                'programa_combo' => 'required|numeric',
                'subprograma_combo' => 'required|numeric',
                'mencion_combo' => 'required|numeric',
                'check' => 'accepted',
            ]);
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

            $expe_model = Expediente::where('estado', 1)
                            ->where(function($query){
                                $query->where('expediente_tipo', 0)
                                    ->orWhere('expediente_tipo', $this->mostrar_tipo_expediente);
                            })
                            ->count();

            $ins_expe_model = ExpedienteInscripcion::where('id_inscripcion', $this->id_inscripcion)
                            ->count();
            
            if($expe_model <= $ins_expe_model){
                // $this->dispatchBrowserEvent('abrir-modal');
                $this->inscripcion();
            }else{
                $this->dispatchBrowserEvent('alertaInscripcion', [
                    'titulo' => 'Expedientes incompletos',
                    'subtitulo' => 'No se puede continuar con la inscripción, ya que no se han subido todos los documentos requeridos.',
                    'icon' => 'warning'
                ]);
                return redirect()->back();
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
        $this->programa_combo = null;
        $this->subprograma_combo = null;
        $this->mencion_combo = null;
        $this->expe = null;
    }

    public function updatedProgramaCombo($programa_combo){
        $this->subprograma_combo_array = SubPrograma::where('id_programa',$programa_combo)->where('estado',1)->get();
        $this->programa_nombre = Programa::where('id_programa',$programa_combo)->first();
        $this->mencion_combo_array = collect();
        $this->subprograma_combo = null;
        $this->mencion_combo = null;
        $programa = Programa::where('id_programa',$programa_combo)->first();
        if($programa){
            $programa = $programa->descripcion_programa;
            if($programa == 'MAESTRIA'){
                $this->mostrar_tipo_expediente = 1;
            }else if($programa == 'DOCTORADO'){
                $this->mostrar_tipo_expediente = 2;
            }
            $this->expe = Expediente::where('estado', 1)
                            ->where(function($query){
                                $query->where('expediente_tipo', 0)
                                    ->orWhere('expediente_tipo', $this->mostrar_tipo_expediente);
                            })
                            ->get();
        }else{
            $this->expe = null;
        }
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

    public function limpiar()
    {
        $this->reset(['expediente', 'expediente_nombre']);
        $this->iteration++;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function aceptarTerminos()
    {
        if($this->check == false){
            $this->check = true;
        }else{
            $this->check = false;
        }
    }

    public function cargarExpediente(Expediente $expediente)
    {
        $this->expediente_nombre = $expediente->tipo_doc;
        $this->expediente_cod_exp = $expediente->cod_exp;
        $this->expediente_requerido = $expediente->requerido;
        $expediente_inscripcion = ExpedienteInscripcion::where('id_inscripcion', $this->id_inscripcion)->where('expediente_cod_exp', $expediente->cod_exp)->first();
        if($expediente_inscripcion){
            $this->modo = 2;
        }else{
            $this->modo = 1;
        }
    }

    public function guardarExpediente()
    {
        $exped = Expediente::where('estado', 1)
                    ->where('cod_exp', $this->expediente_cod_exp)->first();
        // dd($this->expediente->getMimeType(),$this->expediente->getClientOriginalExtension() );
        if($exped->requerido == 1 && $this->modo == 1){
            $this->validate([
                'expediente' => 'required|file|max:10024|mimetypes:application/octet-stream,application/pdf,application/x-pdf,application/x-download,application/force-download',
            ]);
        }else if($exped->requerido == 1 && $this->modo == 2){
            $this->validate([
                'expediente' => 'nullable|file|max:10024|mimetypes:application/octet-stream,application/pdf,application/x-pdf,application/x-download,application/force-download',
            ]);
        }else if($exped->requerido != 1 && $this->modo == 2){
            $this->validate([
                'expediente' => 'nullable|file|max:10024|mimetypes:application/octet-stream,application/pdf,application/x-pdf,application/x-download,application/force-download',
            ]);
        }

        $estadoExpediente = "Enviado";
        $nombreExpediente = $exped->exp_nombre;
        $admision = Admision::where('estado',1)->first()->admision;

        $data = $this->expediente;
        
        if($data != null){
            $path = $admision. '/' .$this->id_inscripcion. '/';
            $filename = $nombreExpediente.".pdf";
            $nombreDB = $path.$filename;
            $data->storeAs($path, $filename, 'files_publico');

            if($this->modo == 1){
                ExpedienteInscripcion::create([
                    "nom_exped" => $nombreDB,
                    "estado" => $estadoExpediente,
                    "expediente_cod_exp" => $this->expediente_cod_exp,
                    "id_inscripcion" => $this->id_inscripcion,
                ]);
            }else{
                $expediente_inscripcion = ExpedienteInscripcion::where('id_inscripcion', $this->id_inscripcion)->where('expediente_cod_exp', $this->expediente_cod_exp)->first();
                $expediente_inscripcion->nom_exped = $nombreDB;
                $expediente_inscripcion->estado = $estadoExpediente;
                $expediente_inscripcion->save();
            }
            
            $this->dispatchBrowserEvent('alertaInscripcion', [
                'titulo' => 'Expediente',
                'subtitulo' => 'Expediente guardado correctamente',
                'icon' => 'success'
            ]);
        }else{
            $this->dispatchBrowserEvent('alertaInscripcion', [
                'titulo' => 'Expediente',
                'subtitulo' => 'No se ha seleccionado ningún expediente',
                'icon' => 'warning'
            ]);
        }
        
        $this->dispatchBrowserEvent('modalExpediente');
        $this->limpiar();
    }

    public function inscripcion()
    {
        $this->dispatchBrowserEvent('alertaFicha');

        // FORMULARIO 1
        $dni_persona = auth('pagos')->user()->dni;
        $persona_buscar = Persona::where('num_doc',$dni_persona)->first();
        if ($this->distrito_nacimiento){
            if ($this->distrito_nacimiento == 1893){
                $pais = $this->pais;
            }else{
                $pais = 'Perú';
            }
        }

        if($persona_buscar){
            $persona_buscar->apell_pater = $this->apellido_paterno;
            $persona_buscar->apell_mater = $this->apellido_materno;
            $persona_buscar->nombres = $this->nombres;
            $persona_buscar->nombre_completo = $this->apellido_paterno.' '.$this->apellido_materno.' '.$this->nombres;
            $persona_buscar->direccion = $this->direccion;
            $persona_buscar->celular1 = $this->celular;
            $persona_buscar->celular2 = $this->celular_opcional;
            $persona_buscar->sexo = $this->genero;
            $persona_buscar->fecha_naci = $this->fecha_nacimiento;
            $persona_buscar->email = $this->correo;
            $persona_buscar->email2 = $this->correo_opcional;
            $persona_buscar->año_egreso = $this->año_egreso;
            $persona_buscar->centro_trab = $this->trabajo;
            $persona_buscar->discapacidad_cod_disc = $this->discapacidad;
            $persona_buscar->est_civil_cod_est = $this->estado_civil;
            $persona_buscar->univer_cod_uni = $this->universidad;
            $persona_buscar->id_grado_academico = $this->grado_academico;
            $persona_buscar->especialidad = $this->especialidad;
            $persona_buscar->pais_extra = $pais;
            $persona_buscar->save();

            $this->id_persona = $persona_buscar->idpersona;

            $ubigeo_distrito = Distrito::select('ubigeo')->where('id',$this->distrito_direccion)->first();
            $ubigeo_direccion = UbigeoPersona::where('tipo_ubigeo_cod_tipo',1)->where('persona_idpersona',$this->id_persona)->first();
            $ubigeo_direccion->id_distrito = $this->distrito_direccion;
            $ubigeo_direccion->ubigeo = $ubigeo_distrito->ubigeo;
            $ubigeo_direccion->save();

            $ubigeo_nacimiento = Distrito::select('ubigeo')->where('id',$this->distrito_nacimiento)->first();
            $ubigeo_nacimiento_persona = UbigeoPersona::where('tipo_ubigeo_cod_tipo',2)->where('persona_idpersona',$this->id_persona)->first();
            $ubigeo_nacimiento_persona->id_distrito = $this->distrito_nacimiento;
            $ubigeo_nacimiento_persona->ubigeo = $ubigeo_nacimiento->ubigeo;
            $ubigeo_nacimiento_persona->save();
        }else{
            $persona = new Persona();
            $persona->num_doc = auth('pagos')->user()->dni;
            $persona->apell_pater = $this->apellido_paterno;
            $persona->apell_mater = $this->apellido_materno;
            $persona->nombres = $this->nombres;
            $persona->nombre_completo = $this->apellido_paterno.' '.$this->apellido_materno.' '.$this->nombres;
            $persona->direccion = $this->direccion;
            $persona->celular1 = $this->celular;
            $persona->celular2 = $this->celular_opcional;
            $persona->sexo = $this->genero;
            $persona->fecha_naci = $this->fecha_nacimiento;
            $persona->email = $this->correo;
            $persona->email2 = $this->correo_opcional;
            $persona->año_egreso = $this->año_egreso;
            $persona->centro_trab = $this->trabajo;
            $persona->discapacidad_cod_disc = $this->discapacidad;
            $persona->est_civil_cod_est = $this->estado_civil;
            $persona->univer_cod_uni = $this->universidad;
            $persona->id_grado_academico = $this->grado_academico;
            $persona->especialidad = $this->especialidad;
            $persona->pais_extra = $pais;
            $persona->save();
    
            $this->id_persona = $persona->idpersona;
            
            $ubigeo_distrito = Distrito::select('ubigeo')->where('id',$this->distrito_direccion)->first();
            $ubigeo_persona_distrito = new UbigeoPersona();
            $ubigeo_persona_distrito->id_distrito = $this->distrito_direccion;
            $ubigeo_persona_distrito->tipo_ubigeo_cod_tipo = 1;
            $ubigeo_persona_distrito->persona_idpersona = $this->id_persona;
            $ubigeo_persona_distrito->ubigeo = $ubigeo_distrito->ubigeo;
            $ubigeo_persona_distrito->save();
    
            $ubigeo_nacimiento = Distrito::select('ubigeo')->where('id',$this->distrito_nacimiento)->first();
            $ubigeo_persona_nacimiento = new UbigeoPersona();
            $ubigeo_persona_nacimiento->id_distrito = $this->distrito_nacimiento;
            $ubigeo_persona_nacimiento->tipo_ubigeo_cod_tipo = 2;
            $ubigeo_persona_nacimiento->persona_idpersona = $this->id_persona;
            $ubigeo_persona_nacimiento->ubigeo = $ubigeo_nacimiento->ubigeo;
            $ubigeo_persona_nacimiento->save();
        }

        // Actulaizacion de datos de inscripcion
        $inscripcion = Inscripcion::find($this->id_inscripcion);
        $inscripcion->persona_idpersona = $this->id_persona;
        $inscripcion->id_mencion = $this->mencion_combo;
        $inscripcion->fecha_inscripcion = now();
        $inscripcion->tipo_programa = $this->mostrar_tipo_expediente;
        $inscripcion->save();

        $admision3 = Admision::where('estado',1)->first();

        // Registro del historial de inscripcion
        $historial_inscripcion = new HistorialInscripcion();
        $historial_inscripcion->persona_documento = auth('pagos')->user()->dni;
        $historial_inscripcion->id_inscripcion = $this->id_inscripcion;
        $historial_inscripcion->admision = $admision3->admision;
        $historial_inscripcion->programa = $this->mencion_combo;
        $historial_inscripcion->historial_inscripcion_fecha = now();
        $historial_inscripcion->admitido = 0;
        $historial_inscripcion->save();

        if($this->check_expediente == true){
            $exp_ins = ExpedienteInscripcion::join('expediente','ex_insc.expediente_cod_exp','=','expediente.cod_exp')
                                                ->where('ex_insc.id_inscripcion',$this->id_inscripcion)
                                                ->where(function($query){
                                                    $query->where('expediente.expediente_tipo', 0)
                                                        ->orWhere('expediente.expediente_tipo', $this->mostrar_tipo_expediente);
                                                })
                                                ->get();
            $exp_seg = ExpedienteTipoSeguimiento::join('expediente','expediente_tipo_seguimiento.cod_exp','=','expediente.cod_exp')
                                                ->where('expediente_tipo_seguimiento_estado', 1)
                                                ->where('tipo_seguimiento', 1)
                                                ->where(function($query){
                                                    $query->where('expediente.expediente_tipo', 0)
                                                        ->orWhere('expediente.expediente_tipo', $this->mostrar_tipo_expediente);
                                                })
                                                ->get();

            $array_seguimiento = [];
            foreach ($exp_ins as $exp) {
                foreach ($exp_seg as $seg) {
                    if($exp->expediente_cod_exp == $seg->cod_exp){
                        array_push($array_seguimiento, $exp->cod_ex_insc);
                    }
                }
            }
            // Registrar datos del seguimiento del expediente de inscripcion
            foreach ($array_seguimiento as $item) {
                $seguimiento_exp_ins = new ExpedienteInscripcionSeguimiento();
                $seguimiento_exp_ins->cod_ex_insc = $item;
                $seguimiento_exp_ins->tipo_seguimiento = 1;
                $seguimiento_exp_ins->expediente_inscripcion_seguimiento_estado = 1;
                $seguimiento_exp_ins->save();
            }
        }

        // Eliminar expedientes de la inscripcion que no son del programa elegido
        $expediente_inscripcion = ExpedienteInscripcion::where('id_inscripcion',$this->id_inscripcion)->get();
        // delete storage file and database
        foreach($expediente_inscripcion as $exp){
            $expediente = Expediente::where('cod_exp', $exp->expediente_cod_exp)
                                        ->where(function($query){
                                            $query->where('expediente_tipo', 0)
                                                ->orWhere('expediente_tipo', $this->mostrar_tipo_expediente);
                                        })
                                        ->first();
            if($expediente === null){
                $exp->delete();
                File::delete($exp->nom_exped);
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

        return view('livewire.modulo_inscripcion.inscripcion.create',[
            'est' => $est_civil,
            'tipo_dis' => $tipo_dis,
            'uni' => $uni,
            'grad' => $grad,
        ]);
    }
}

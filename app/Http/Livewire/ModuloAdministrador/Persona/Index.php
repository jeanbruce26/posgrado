<?php

namespace App\Http\Livewire\ModuloAdministrador\Persona;

use App\Models\Admision;
use App\Models\Departamento;
use App\Models\Persona;
use App\Models\Discapacidad;
use App\Models\Distrito;
use App\Models\EstadoCivil;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use App\Models\ExpedienteInscripcionSeguimiento;
use App\Models\Universidad;
use App\Models\GradoAcademico;
use App\Models\HistorialAdministrativo;
use App\Models\Inscripcion;
use App\Models\InscripcionPago;
use App\Models\Mencion;
use App\Models\Provincia;
use App\Models\UbigeoPersona;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class Index extends Component
{
    protected $queryString = [
        'search' => ['except' => ''],
        'filtro_programa' => ['except' => ''],
        'sort_nombre' => ['except' => 'nombre_completo'],
        'sort_direccion' => ['except' => 'asc'],
    ];
    
    public $search = '';
    public $titulo = 'Mostrar Datos del Estudiante';
    public $modo = 1; 
    //1=view / 2=update

    public $persona_id;

    public $documento;
    public $nombres;
    public $apellidoPate;
    public $apellidoMate;
    public $fechaNacimineto;
    public $sexo;
    public $estadoCivil;
    public $direccion;
    public $discapacidad;
    public $celular1;
    public $celular2;
    public $email1;
    public $email2;
    public $centroTrabajo;
    public $universidad;
    public $anioEgreso;
    public $gradoAcademico;
    public $especialidad;
    public $tipoDocumento;
    public $pais;

    public $departamento_direccion, $departamento_direccion_array, $provincia_direccion, $provincia_direccion_array, $distrito_direccion, $distrito_direccion_array; // Direccion
    public $departamento_nacimiento, $departamento_nacimiento_array, $provincia_nacimiento, $provincia_nacimiento_array, $distrito_nacimiento, $distrito_nacimiento_array; // Nacimiento

    // para el filtor de programa
    public $filtro_programa;
    
    public $sort_nombre = 'nombre_completo'; // Columna de la tabla a ordenar
    public $sort_direccion = 'asc'; // Orden de la columna a ordenar

    public function moun()
    {
        $this->departamento_direccion_array = Departamento::all();
        $this->provincia_direccion_array = collect();
        $this->distrito_direccion_array = collect();
        $this->departamento_nacimiento_array = Departamento::all();
        $this->provincia_nacimiento_array = collect();
        $this->distrito_nacimiento_array = collect();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'documento' => 'required|digits_between:8,9|numeric',
            'nombres' => 'required|string',
            'apellidoPate' => 'required|string',
            'apellidoMate' => 'required|string',
            'fechaNacimineto' => 'required|date',
            'sexo' => 'required|string',
            'estadoCivil' => 'required|numeric',
            'direccion' => 'required',
            'discapacidad' => 'nullable|numeric',
            'celular1' => 'required|numeric',
            'celular2' => 'nullable|numeric',
            'email1' => 'required',
            'email2' => 'nullable',
            'centroTrabajo' => 'required',
            'universidad' => 'required|numeric',
            'anioEgreso' => 'required|numeric',
            'gradoAcademico' => 'required|numeric',
            'especialidad' => 'nullable|string',
            'tipoDocumento' => 'nullable|numeric',
            'pais' => 'nullable|string',
            'departamento_direccion' => 'required|numeric',
            'provincia_direccion' => 'required|numeric',
            'distrito_direccion' => 'required|numeric',
            'departamento_nacimiento' => 'required|numeric',
            'provincia_nacimiento' => 'required|numeric',
            'distrito_nacimiento' => 'required|numeric',
        ]);
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('documento','nombres','apellidoPate','apellidoMate','fechaNacimineto','sexo','estadoCivil','direccion','discapacidad','celular1','celular2','email1','email2','centroTrabajo','universidad','anioEgreso','gradoAcademico','especialidad','tipoDocumento','pais', 'departamento_direccion', 'provincia_direccion', 'distrito_direccion', 'departamento_nacimiento', 'provincia_nacimiento', 'distrito_nacimiento');
        $this->modo = 1;
        $this->titulo = "Mostrar Datos del Estudiante";
    }

    public function cargarPersona(Persona $persona){
        $this->limpiar();

        $this->modo = 1;
        $this->titulo = 'Mostrar Datos del Estudiante - '.$persona->nombres.' '.$persona->apell_pater.' '.$persona->apell_mater;
        $this->persona_id = $persona->idpersona;

        $this->documento = $persona->num_doc;
        $this->nombres = $persona->nombres;
        $this->apellidoPate = $persona->apell_pater;
        $this->apellidoMate = $persona->apell_mater;
        $this->fechaNacimineto = date('d/m/Y', strtotime($persona->fecha_naci));
        $this->sexo = $persona->sexo;
        $this->estadoCivil = $persona->EstadoCivil->est_civil;
        $this->direccion = $persona->direccion;
        $this->discapacidad = $persona->discapacidad_cod_disc;
        $this->celular1 = $persona->celular1;
        $this->celular2 = $persona->celular2;
        $this->email1 = $persona->email;
        $this->email2 = $persona->email2;
        $this->centroTrabajo = $persona->centro_trab;
        $this->universidad = $persona->Universidad->universidad;
        $this->anioEgreso = $persona->año_egreso;
        $this->gradoAcademico = $persona->GradoAcademico->nom_grado;
        $this->especialidad = $persona->especialidad;
        $ubi_dire = UbigeoPersona::where('persona_idpersona',$persona->idpersona)->where('tipo_ubigeo_cod_tipo',1)->first();
        $ubi_naci = UbigeoPersona::where('persona_idpersona',$persona->idpersona)->where('tipo_ubigeo_cod_tipo',2)->first();
        $this->departamento_direccion = $ubi_dire->Distrito->Provincia->Departamento->departamento;
        $this->provincia_direccion = $ubi_dire->Distrito->Provincia->provincia;
        $this->distrito_direccion = $ubi_dire->Distrito->distrito;
        $this->departamento_nacimiento = $ubi_naci->Distrito->Provincia->Departamento->departamento;
        $this->provincia_nacimiento = $ubi_naci->Distrito->Provincia->provincia;
        $this->distrito_nacimiento = $ubi_naci->Distrito->distrito;
    }
    
    public function cargarPersonaUpdate(Persona $persona){
        $this->limpiar();
        $this->modo = 2;
        $this->titulo = 'Actualizar Datos del Estudiante - '.$persona->nombres.' '.$persona->apell_pater.' '.$persona->apell_mater;
        $this->persona_id = $persona->idpersona;

        $this->documento = $persona->num_doc;
        $this->nombres = $persona->nombres;
        $this->apellidoPate = $persona->apell_pater;
        $this->apellidoMate = $persona->apell_mater;
        $this->fechaNacimineto = $persona->fecha_naci;
        $this->sexo = $persona->sexo;
        $this->estadoCivil = $persona->est_civil_cod_est;
        $this->direccion = $persona->direccion;
        $this->discapacidad = $persona->discapacidad_cod_disc;
        $this->celular1 = $persona->celular1;
        $this->celular2 = $persona->celular2;
        $this->email1 = $persona->email;
        $this->email2 = $persona->email2;
        $this->centroTrabajo = $persona->centro_trab;
        $this->universidad = $persona->univer_cod_uni;
        $this->anioEgreso = $persona->año_egreso;
        $this->gradoAcademico = $persona->id_grado_academico;
        $this->especialidad = $persona->especialidad;
        $ubigeo_direccion = UbigeoPersona::where('persona_idpersona',$persona->idpersona)->where('tipo_ubigeo_cod_tipo',1)->first();
        $id_distrito_direccion = $ubigeo_direccion->id_distrito;
        $distrito_direccion = Distrito::where('id',$id_distrito_direccion)->first();
        $id_provincia_direccion = $distrito_direccion->id_provincia;
        $provincia_direccion = Provincia::where('id',$id_provincia_direccion)->first();
        $id_departamento_direccion = $provincia_direccion->id_departamento;
        $ubigeo_nacimiento = UbigeoPersona::where('persona_idpersona',$persona->idpersona)->where('tipo_ubigeo_cod_tipo',2)->first();
        $id_distrito_nacimiento = $ubigeo_nacimiento->id_distrito;
        $distrito_nacimiento = Distrito::where('id',$id_distrito_nacimiento)->first();
        $id_provincia_nacimiento = $distrito_nacimiento->id_provincia;
        $provincia_nacimiento = Provincia::where('id',$id_provincia_nacimiento)->first();
        $id_departamento_nacimiento = $provincia_nacimiento->id_departamento;
        $this->departamento_direccion_array = Departamento::all();
        $this->provincia_direccion_array = Provincia::where('id_departamento', $id_departamento_direccion)->get();
        $this->distrito_direccion_array = Distrito::where('id_provincia', $id_provincia_direccion)->get();
        $this->departamento_direccion = $id_departamento_direccion;
        $this->provincia_direccion = $id_provincia_direccion;
        $this->distrito_direccion = $id_distrito_direccion;
        $this->departamento_nacimiento_array = Departamento::all();
        $this->provincia_nacimiento_array = Provincia::where('id_departamento', $id_departamento_nacimiento)->get();
        $this->distrito_nacimiento_array = Distrito::where('id_provincia', $id_provincia_nacimiento)->get();
        $this->departamento_nacimiento = $id_departamento_nacimiento;
        $this->provincia_nacimiento = $id_provincia_nacimiento;
        $this->distrito_nacimiento = $id_distrito_nacimiento;
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

    public function guardarPersona(){
        $this->validate([
            'documento' => 'required|digits_between:8,9|numeric',
            'nombres' => 'required|string',
            'apellidoPate' => 'required|string',
            'apellidoMate' => 'required|string',
            'fechaNacimineto' => 'required|date',
            'sexo' => 'required|string',
            'estadoCivil' => 'required|numeric',
            'direccion' => 'required',
            'discapacidad' => 'nullable|numeric',
            'celular1' => 'required|numeric',
            'celular2' => 'nullable|numeric',
            'email1' => 'required',
            'email2' => 'nullable',
            'centroTrabajo' => 'required',
            'universidad' => 'required|numeric',
            'anioEgreso' => 'required|numeric',
            'gradoAcademico' => 'required|numeric',
            'especialidad' => 'nullable|string',
            'tipoDocumento' => 'nullable|numeric',
            'pais' => 'nullable|string',
            'departamento_direccion' => 'required|numeric',
            'provincia_direccion' => 'required|numeric',
            'distrito_direccion' => 'required|numeric',
            'departamento_nacimiento' => 'required|numeric',
            'provincia_nacimiento' => 'required|numeric',
            'distrito_nacimiento' => 'required|numeric',
        ]);

        $persona = Persona::find($this->persona_id);
        
        $persona->num_doc = $this->documento;
        $persona->nombres = $this->nombres;
        $persona->apell_pater = $this->apellidoPate;
        $persona->apell_mater = $this->apellidoMate;
        $persona->nombre_completo = $this->apellidoPate.' '.$this->apellidoMate.' '.$this->nombres;
        $persona->fecha_naci = $this->fechaNacimineto;
        $persona->sexo = $this->sexo;
        $persona->est_civil_cod_est  = $this->estadoCivil;
        $persona->direccion = $this->direccion;
        if($persona->discapacidad_cod_disc){
            $persona->discapacidad_cod_disc = $this->discapacidad;
        }
        $persona->celular1 = $this->celular1;
        if($persona->celular2){
            $persona->celular2 = $this->celular2;
        }
        $persona->email = $this->email1;
        if($persona->email2){
            $persona->email2 = $this->email2;
        }
        $persona->centro_trab = $this->centroTrabajo;
        $persona->univer_cod_uni = $this->universidad;
        $persona->año_egreso = $this->anioEgreso;
        $persona->id_grado_academico = $this->gradoAcademico;
        if($persona->especialidad){
            $persona->especialidad = $this->especialidad;
        }
        if($persona->pais_extra){
            $persona->pais_extra = $this->pais;
        }
        // dd($persona);
        $persona->save();

        // guardar de ubigeo
        $ubigeo_distrito = Distrito::select('ubigeo')->where('id',$this->distrito_direccion)->first();
        $ubigeo_direccion = UbigeoPersona::where('tipo_ubigeo_cod_tipo',1)->where('persona_idpersona',$this->persona_id)->first();
        $ubigeo_direccion->id_distrito = $this->distrito_direccion;
        $ubigeo_direccion->ubigeo = $ubigeo_distrito->ubigeo;
        $ubigeo_direccion->save();

        $ubigeo_nacimiento = Distrito::select('ubigeo')->where('id',$this->distrito_nacimiento)->first();
        $ubigeo_nacimiento_persona = UbigeoPersona::where('tipo_ubigeo_cod_tipo',2)->where('persona_idpersona',$this->persona_id)->first();
        $ubigeo_nacimiento_persona->id_distrito = $this->distrito_nacimiento;
        $ubigeo_nacimiento_persona->ubigeo = $ubigeo_nacimiento->ubigeo;
        $ubigeo_nacimiento_persona->save();

        // guardar nueva ficha de inscripcion
        $inscripcion = Inscripcion::join('persona','persona.idpersona','=','inscripcion.persona_idpersona')
                            ->where('persona.num_doc',$this->documento)
                            ->first(); // buscamos el id de la inscripcion por medio del documento de identidad de la persona
        $this->pdfUser($inscripcion->id_inscripcion);

        $this->dispatchBrowserEvent('notificacionEstudiante', ['message' =>'Estudiante actualizado satisfactoriamente.', 'color' => '#2eb867']);
        $this->subirHistorial($persona->idpersona, 'Actualización de Estudiante', 'persona');

        $this->dispatchBrowserEvent('modalPersona');
        $this->limpiar();
    }
    
    public function pdfUser($id)
    {
        $inscripcion = Inscripcion::where('id_inscripcion',$id)->first();

        $montoTotal=0;

        $inscripcion_pago = InscripcionPago::where('inscripcion_id',$id)->get();
        foreach($inscripcion_pago as $item){
            $montoTotal = $montoTotal + $item->pago->monto;
        }

        $admision3 = Admision::where('estado',1)->first();
        $admi = $admision3->admision;

        $fecha_actual = $inscripcion->fecha_inscripcion->format('h:i:s a d/m/Y');
        $fecha_actual2 = $inscripcion->fecha_inscripcion->format('d-m-Y');
        $mencion = Mencion::where('id_mencion',$inscripcion->id_mencion)->get();
        $admisionn = Admision::where('estado',1)->get();
        $inscrip = Inscripcion::where('id_inscripcion',$id)->get();
        $inscripcion_codigo = Inscripcion::where('id_inscripcion',$id)->first()->inscripcion_codigo;
        $tiempo = 6;
        $valor = '+ '.intval($tiempo).' month';
        setlocale( LC_ALL,"es_ES@euro","es_ES","esp" );
        $final = strftime('%d de %B del %Y', strtotime($fecha_actual2.$valor));
        $per = Persona::where('idpersona', $inscripcion->persona_idpersona)->get();
        $expedienteInscripcion = ExpedienteInscripcion::where('id_inscripcion',$id)->get();
        $expedi = $expedi = Expediente::where('estado', 1)
                    ->where(function($query) use ($inscripcion){
                        $query->where('expediente_tipo', 0)
                            ->orWhere('expediente_tipo', $inscripcion->tipo_programa);
                    })
                    ->get();

        // verificamos si tiene expediente en seguimientos
        $seguimiento_count = ExpedienteInscripcionSeguimiento::join('ex_insc', 'ex_insc.cod_ex_insc', '=', 'expediente_inscripcion_seguimiento.cod_ex_insc')
                                                        ->where('ex_insc.id_inscripcion', $id)
                                                        ->where('expediente_inscripcion_seguimiento.tipo_seguimiento', 1)
                                                        ->where('expediente_inscripcion_seguimiento.expediente_inscripcion_seguimiento_estado', 1)
                                                        ->count();

        $data = [ 
            'persona' => $per,
            'fecha_actual' => $fecha_actual,
            'mencion' => $mencion,
            'admisionn' => $admisionn,
            'inscripcion_pago' => $inscripcion_pago,
            'inscrip' => $inscrip,
            'inscripcion_codigo' => $inscripcion_codigo,
            'montoTotal' => $montoTotal,
            'final' => $final,
            'expedienteInscripcion' => $expedienteInscripcion,
            'expedi' => $expedi,
            'seguimiento_count' => $seguimiento_count,
        ];

        $nombre_pdf = 'FICHA_INSCRIPCION.pdf';
        $path_pdf = $admi.'/'.$id.'/'.$nombre_pdf;
        $pdf = Pdf::loadView('modulo_inscripcion.inscripcion.reporte-pdf', $data)->save(public_path($admi.'/'.$id.'/'). $nombre_pdf);

        $ins = Inscripcion::find($id);
        $ins->inscripcion = $path_pdf;
        $ins->save();
    }
    
    public function subirHistorial($usuario_id, $descripcion, $tabla)
    {
        HistorialAdministrativo::create([
            "usuario_id" => auth('admin')->user()->usuario_id,
            "trabajador_id" => auth('admin')->user()->TrabajadorTipoTrabajador->Trabajador->trabajador_id,
            "historial_descripcion" => $descripcion,
            "historial_tabla" => $tabla,
            "historial_usuario_id" => $usuario_id,
            "historial_fecha" => now()
        ]);
    }

    public function sort($value)
    {
        if ($this->sort_nombre == $value) {
            if ($this->sort_direccion == 'asc') {
                $this->sort_direccion = 'desc';
            } else {
                $this->sort_direccion = 'asc';
            }
        } else {
            $this->sort_nombre = $value;
            $this->sort_direccion = 'asc';
        }
    }

    public function limpiar_filtro()
    {
        $this->reset('filtro_programa');
    }

    public function render()
    {
        $buscar = $this->search;
        if($this->filtro_programa)
        {
            $inscripciones = Inscripcion::join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->where('mencion.id_mencion',$this->filtro_programa)
                ->where(function($query){
                    $query->where('persona.nombres','LIKE',"%{$this->search}%")
                        ->orWhere('persona.apell_pater','LIKE',"%{$this->search}%")
                        ->orWhere('persona.apell_mater','LIKE',"%{$this->search}%")
                        ->orWhere('persona.nombre_completo','LIKE',"%{$this->search}%")
                        ->orWhere('persona.num_doc','LIKE',"%{$this->search}%")
                        ->orWhere('persona.sexo','LIKE',"%{$this->search}%")
                        ->orWhere('persona.celular1','LIKE',"%{$this->search}%");
                })
                ->orderBy('persona.idpersona','asc')
                ->get();

            $ubigeo_persona = UbigeoPersona::join('persona','ubi_pers.persona_idpersona','=','persona.idpersona')
                ->join('distrito','ubi_pers.id_distrito','=','distrito.id')
                ->join('provincia','distrito.id_provincia','=','provincia.id')
                ->join('departamento','provincia.id_departamento','=','departamento.id')
                ->where(function ($query) use ($buscar) {
                    $query->where('persona.idpersona','LIKE',"%{$buscar}%")
                        ->orWhere('persona.num_doc','LIKE',"%{$buscar}%")
                        ->orWhere('persona.nombres','LIKE',"%{$buscar}%")
                        ->orWhere('persona.apell_pater','LIKE',"%{$buscar}%")
                        ->orWhere('persona.apell_mater','LIKE',"%{$buscar}%")
                        ->orWhere('persona.nombre_completo','LIKE',"%{$buscar}%")
                        ->orWhere('persona.fecha_naci','LIKE',"%{$buscar}%")
                        ->orWhere('persona.sexo','LIKE',"%{$buscar}%")
                        ->orWhere('persona.celular1','LIKE',"%{$buscar}%");
                })
                ->where('ubi_pers.tipo_ubigeo_cod_tipo', 1)
                ->orderBy($this->sort_nombre == 'nombre_completo' ? 'persona.' . $this->sort_nombre :'departamento.' .  $this->sort_nombre, $this->sort_direccion)
                ->get();
            
            $personaModel = collect();
            foreach ($ubigeo_persona as $key => $value) {
                foreach ($inscripciones as $key2 => $value2) {
                    if($value->persona_idpersona == $value2->persona_idpersona)
                    {
                        $personaModel->push($value);
                    }
                }
            }
        }else{
            $personaModel = UbigeoPersona::join('persona','ubi_pers.persona_idpersona','=','persona.idpersona')
                        ->join('distrito','ubi_pers.id_distrito','=','distrito.id')
                        ->join('provincia','distrito.id_provincia','=','provincia.id')
                        ->join('departamento','provincia.id_departamento','=','departamento.id')
                        ->where(function ($query) use ($buscar) {
                            $query->where('persona.idpersona','LIKE',"%{$buscar}%")
                                ->orWhere('persona.num_doc','LIKE',"%{$buscar}%")
                                ->orWhere('persona.nombres','LIKE',"%{$buscar}%")
                                ->orWhere('persona.apell_pater','LIKE',"%{$buscar}%")
                                ->orWhere('persona.apell_mater','LIKE',"%{$buscar}%")
                                ->orWhere('persona.nombre_completo','LIKE',"%{$buscar}%")
                                ->orWhere('persona.fecha_naci','LIKE',"%{$buscar}%")
                                ->orWhere('persona.sexo','LIKE',"%{$buscar}%")
                                ->orWhere('persona.celular1','LIKE',"%{$buscar}%");
                        })
                        ->where('ubi_pers.tipo_ubigeo_cod_tipo', 1)
                        ->orderBy($this->sort_nombre == 'nombre_completo' ? 'persona.' . $this->sort_nombre :'departamento.' .  $this->sort_nombre, $this->sort_direccion)
                        ->get();
        }
        
        $discapacidadModel = Discapacidad::all();
        $estadoCivilModel = EstadoCivil::all();
        $universidadModel = Universidad::all();
        $gradoAcademicoModel = GradoAcademico::all();

        $programas_model = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->where('mencion.mencion_estado', 1)
                ->orderBy('programa.descripcion_programa','ASC')
                ->orderBy('subprograma.subprograma','ASC')
                ->get();
        return view('livewire.modulo-administrador.persona.index', [
            'personaModel' => $personaModel,
            'discapacidadModel' => $discapacidadModel,
            'estadoCivilModel' => $estadoCivilModel,
            'universidadModel' => $universidadModel,
            'gradoAcademicoModel' => $gradoAcademicoModel,
            'programas_model' => $programas_model,
        ]);
    }
}

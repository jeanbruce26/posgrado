<?php

namespace App\Http\Livewire\ModuloAdministrador\Persona;

use App\Models\Admision;
use App\Models\Persona;
use App\Models\Discapacidad;
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
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class Index extends Component
{
    protected $queryString = [
        'search' => ['except' => '']
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
        ]);
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('documento','nombres','apellidoPate','apellidoMate','fechaNacimineto','sexo','estadoCivil','direccion','discapacidad','celular1','celular2','email1','email2','centroTrabajo','universidad','anioEgreso','gradoAcademico','especialidad','tipoDocumento','pais');
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

    public function render()
    {
        $buscar = $this->search;
        $personaModel = Persona::where('idpersona','LIKE',"%{$buscar}%")
                        ->orWhere('num_doc','LIKE',"%{$buscar}%")
                        ->orWhere('nombres','LIKE',"%{$buscar}%")
                        ->orWhere('apell_pater','LIKE',"%{$buscar}%")
                        ->orWhere('apell_mater','LIKE',"%{$buscar}%")
                        ->orWhere('nombre_completo','LIKE',"%{$buscar}%")
                        ->orWhere('fecha_naci','LIKE',"%{$buscar}%")
                        ->orWhere('sexo','LIKE',"%{$buscar}%")
                        ->orWhere('celular1','LIKE',"%{$buscar}%")
                        ->orderBy('idpersona','DESC')->get();
        $discapacidadModel = Discapacidad::all();
        $estadoCivilModel = EstadoCivil::all();
        $universidadModel = Universidad::all();
        $gradoAcademicoModel = GradoAcademico::all();
        return view('livewire.modulo-administrador.persona.index', [
            'personaModel' => $personaModel,
            'discapacidadModel' => $discapacidadModel,
            'estadoCivilModel' => $estadoCivilModel,
            'universidadModel' => $universidadModel,
            'gradoAcademicoModel' => $gradoAcademicoModel,
        ]);
    }
}

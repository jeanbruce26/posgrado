<?php

namespace App\Http\Controllers\ModuloCoordinador;

use App\Http\Controllers\Controller;
use App\Models\Admision;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Evaluacion;
use App\Models\Mencion;
use App\Models\TrabajadorTipoTrabajador;

class CoordinadorController extends Controller
{
    public function index()
    {
        return view('modulo_coordinador.index');
    }
    
    public function inscripciones($id)
    {
        return view('modulo_coordinador.inscripcion', compact('id'));
    }

    public function expediente($id, $tipo)
    {
        return view('modulo_coordinador.expediente', [
            'id' => $id,
            'tipo' => $tipo
        ]);
    }

    public function entrevista($id, $tipo)
    {
        return view('modulo_coordinador.entrevista', [
            'id' => $id,
            'tipo' => $tipo
        ]);
    }

    public function investigacion($id, $tipo)
    {
        return view('modulo_coordinador.investigacion', [
            'id' => $id,
            'tipo' => $tipo
        ]);
    }

    public function reportes_maestria($mencion_id)
    {
        setlocale( LC_ALL,"es_ES@euro","es_ES","esp" );

        $evaluaciones = Evaluacion::join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('facultad','subprograma.facultad_id','=','facultad.facultad_id')
                ->where('mencion.id_mencion',$mencion_id)
                ->orderBy('persona.nombre_completo','asc')
                ->get();

        $facultad = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('facultad','subprograma.facultad_id','=','facultad.facultad_id')
                ->where('mencion.id_mencion',$mencion_id)
                ->first()->facultad;

        $fecha = today();
        $fecha2 = date('dmY', strtotime($fecha));

        $trabajador = TrabajadorTipoTrabajador::where('trabajador_tipo_trabajador_id',auth('admin')->user()->trabajador_tipo_trabajador_id)
                ->first()
                ->Trabajador;

        $coordinador = $trabajador->trabajador_apellidos . ', ' . $trabajador->trabajador_nombres;
    
        $programa = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->where('mencion.id_mencion',$mencion_id)
                ->first();
        $mencion = $programa->mencion;
        $mencion = ucwords(strtolower($mencion));
        $maestria = $programa->subprograma;
        $maestria = ucwords(strtolower($maestria));

        $admision = Admision::where('estado', 1)->first();
        $admision = ucwords(strtolower($admision->admision));
        
        $data = [ 
            'evaluaciones' => $evaluaciones,
            'facultad' => $facultad,
            'fecha' => $fecha,
            'coordinador' => $coordinador,
            'programa' => $programa,
            'admision' => $admision,
            'mencion' => $mencion,
            'maestria' => $maestria
        ];

        // Crea una instancia de la clase PDF
        $pdf = PDF::loadView('modulo_coordinador.reporte-evaluacion-maestria', $data);
        // $pdf = PDF::loadView('example', $data);

        // Configura el tamaño de papel A4 y los márgenes en milímetros
        $pdf->setPaper('a4', 'portrait');
        $pdf->setPaper('150mm', '80mm', '150mm', '80mm');

        // Genera el PDF y lo envía al navegador para su descarga
        return $pdf->stream('acta-evaluacion-'.$fecha2.'.pdf');
    }

    public function reportes_doctorado($mencion_id)
    {
        setlocale( LC_ALL,"es_ES@euro","es_ES","esp" );

        $evaluaciones = Evaluacion::join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('facultad','subprograma.facultad_id','=','facultad.facultad_id')
                ->where('mencion.id_mencion',$mencion_id)
                ->orderBy('persona.nombre_completo','asc')
                ->get();

        $facultad = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('facultad','subprograma.facultad_id','=','facultad.facultad_id')
                ->where('mencion.id_mencion',$mencion_id)
                ->first()->facultad;

        $fecha = today();
        $fecha2 = date('dmY', strtotime($fecha));

        $trabajador = TrabajadorTipoTrabajador::where('trabajador_tipo_trabajador_id',auth('admin')->user()->trabajador_tipo_trabajador_id)
                ->first()
                ->Trabajador;

        $coordinador = $trabajador->trabajador_apellidos . ', ' . $trabajador->trabajador_nombres;

        $programa = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->where('mencion.id_mencion',$mencion_id)
                ->first();
        
        $mencion = $programa->mencion;
        $doctorado = $programa->subprograma;
        $doctorado = ucwords(strtolower($doctorado));

        $admision = Admision::where('estado', 1)->first();
        $admision = ucwords(strtolower($admision->admision));

        $data = [ 
            'evaluaciones' => $evaluaciones,
            'facultad' => $facultad,
            'fecha' => $fecha,
            'coordinador' => $coordinador,
            'programa' => $programa,
            'admision' => $admision,
            'mencion' => $mencion,
            'doctorado' => $doctorado
        ];

        $pdf = PDF::loadView('modulo_coordinador.reporte-evaluacion-doctorado', $data);

        return $pdf->stream('acta-evaluacion-'.$fecha2.'.pdf');
    }

    public function perfil()
    {
        $tipo = 'coordinador';
        return view('modulo_administrador.Perfil.index', [
            'tipo' => $tipo
        ]);
    }

    public function modulo_inscripcion_index()
    {
        return view('modulo_coordinador.modulo-inscripcion.index');
    }

    public function modulo_inscripcion($id_mencion)
    {
        $dato_programa = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                                ->where('mencion.id_mencion',$id_mencion)
                                ->first();

        if($dato_programa->mencion === null){
            $programa = $dato_programa->descripcion_programa . ' EN ' . $dato_programa->subprograma;
            $programa = ucwords(strtolower($programa));
        }else{
            $programa = 'MENCION EN ' . $dato_programa->mencion;
            $programa = ucwords(strtolower($programa));
        }

        return view('modulo_coordinador.modulo-inscripcion.inscripciones', [
            'id_mencion' => $id_mencion,
            'programa' => $programa
        ]);
    }

    public function matriculados()
    {
        return view('modulo_coordinador.matriculados.index');
    }

    public function auth()
    {
        return view('modulo_coordinador.vista-docentes.auth.index');
    }


    public function logout()
    {
        auth('evaluacion')->logout();
        return redirect()->route('coordinador.auth.index');
    }

    public function programas()
    {
        // $programas = Programa::all();
        return view('modulo_coordinador.vista-docentes.evaluacion.index');
    }

    public function programas_inscripciones($id_mencion)
    {
        return view('modulo_coordinador.vista-docentes.evaluacion.inscripcion', [
            'id_mencion' => $id_mencion
        ]);
    }

    public function programas_entrevista($id, $tipo)
    {
        return view('modulo_coordinador.vista-docentes.evaluacion.entrevista', [
            'id' => $id,
            'tipo' => $tipo
        ]);
    }

    public function programas_investigacion($id, $tipo)
    {
        return view('modulo_coordinador.vista-docentes.evaluacion.investigacion', [
            'id' => $id,
            'tipo' => $tipo
        ]);
    }
}

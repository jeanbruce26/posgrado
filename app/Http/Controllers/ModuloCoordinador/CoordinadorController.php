<?php

namespace App\Http\Controllers\ModuloCoordinador;

use App\Http\Controllers\Controller;
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

    public function expediente($id)
    {
        return view('modulo_coordinador.expediente', compact('id'));
    }

    public function entrevista($id)
    {
        return view('modulo_coordinador.entrevista', compact('id'));
    }

    public function reportes($mencion_id)
    {
        date_default_timezone_set("America/Lima");

        $evaluaciones = Evaluacion::join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('facultad','subprograma.facultad_id','=','facultad.facultad_id')
                ->where('mencion.id_mencion',$mencion_id)
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
        
        $data = [ 
            'evaluaciones' => $evaluaciones,
            'facultad' => $facultad,
            'fecha' => $fecha,
            'coordinador' => $coordinador,
            'programa' => $programa,
        ];

        // dd($programa);

        $pdf = PDF::loadView('modulo_coordinador.reporte-evaluacion', $data);

        return $pdf->stream('acta-evaluacion-'.$fecha2.'.pdf');
    }
}

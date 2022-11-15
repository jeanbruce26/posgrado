<?php

namespace App\Http\Controllers\ModuloInscripcion\Inscripcion;

use App\Models\Admision;
use App\Models\ConceptoPago;
use App\Models\Discapacidad;
use App\Models\Distrito;
use App\Models\EstadoCivil;
use App\Models\GradoAcademico;
use App\Models\TipoDocumento;
use App\Models\Universidad;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use App\Models\IngresoPago;
use App\Models\Inscripcion;
use App\Models\InscripcionPago;
use App\Models\Mencion;
use App\Models\Pago;
use App\Models\Persona;
use App\Models\UbigeoPersona;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class UserInscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modulo_inscripcion.inscripcion.terminos-condiciones');
    }

    public function index2()
    {
        $concepto = ConceptoPago::all();
        $tipo_doc = TipoDocumento::all();
        return view('modulo_inscripcion.inscripcion.pagos', compact('concepto', 'tipo_doc'));
    }

    public function inscripcion($id)
    {
        return view('modulo_inscripcion.inscripcion.create', compact('id'));
    }

    public function pdf($id)
    {
        date_default_timezone_set("America/Lima");
        
        $inscripcion = Inscripcion::where('id_inscripcion',$id)->first();

        $montoTotal=0;
        $inscripcion_pago = InscripcionPago::where('inscripcion_id',$id)->get();
        foreach($inscripcion_pago as $item){
            $pago_id = $item->pago_id;
            $pago = Pago::find($pago_id);
            $pago->estado = 3;
            $pago->save();

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
        $expedi = Expediente::all();

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
        ];

        $nombre_pdf = 'FICHA_INSCRIPCION.pdf';
        $pdf = PDF::loadView('modulo_inscripcion.inscripcion.reporte-pdf', $data)->save(public_path($admi.'/'.$id.'/'). $nombre_pdf);
        $pdf2 = PDF::loadView('modulo_inscripcion.inscripcion.reporte-pdf', $data);

        $ins = Inscripcion::find($id);
        $ins->inscripcion = $nombre_pdf;
        $ins->save();

        auth('pagos')->logout();

        return $pdf2->stream($nombre_pdf);
    }
}

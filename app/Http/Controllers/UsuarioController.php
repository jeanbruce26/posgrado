<?php

namespace App\Http\Controllers;

use App\Models\Admision;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use App\Models\Inscripcion;
use App\Models\InscripcionPago;
use App\Models\Mencion;
use App\Models\Pago;
use App\Models\Persona;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('modulo_inscripcion.usuario.index');
    }

    public function create()
    {
        return view('modulo_inscripcion.usuario.create');
    }

    public function edit()
    {
        return view('modulo_inscripcion.usuario.update');
    }

    public function pdf($id)
    {
        date_default_timezone_set("America/Lima");
        
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
        $tiempo = 6;
        $valor = '+ '.intval($tiempo).' month';
        $final = date('j-m-Y',strtotime($fecha_actual2.$valor));
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
            'montoTotal' => $montoTotal,
            'final' => $final,
            'expedienteInscripcion' => $expedienteInscripcion,
            'expedi' => $expedi,
        ];

        $nombre_pdf = 'FICHA_INSCRIPCION.pdf';
        $pdf = PDF::loadView('modulo_inscripcion.inscripcion.reporte-pdf', $data)->save(public_path($admi.'/'.$id.'/'). $nombre_pdf);

        $ins = Inscripcion::find($id);
        $ins->inscripcion = $nombre_pdf;
        $ins->save();

        session()->flash('message', 'Documento ingresado correctamente.');

        return redirect()->route('usuarios.edit');
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\ModuloAdministrador\Evaluaciones\ExportData;
use App\Http\Controllers\Controller;
use App\Models\Admitidos;
use App\Models\Evaluacion;
use App\Models\Inscripcion;
use App\Models\Mencion;
use App\Models\Pago;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $programas_maestria = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->where('programa.id_programa', 1) // 1 = Maestria
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();

        $programas_doctorado = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->where('programa.id_programa', 2) // 2 = Doctorado
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();


        $ingreso_total = Pago::sum('monto');
        $ingreso_inscripcion = Pago::where('estado', 3)->sum('monto');
        $ingreso_constancia = Pago::where('estado', 4)->sum('monto');
        $ingreso_matricula = Pago::where('estado', 5)->sum('monto');

        $pagos = Pago::all();
        $evaluados = Evaluacion::where('evaluacion_estado', 3)->count();
        $admitidos = Admitidos::all()->count();

        return view('modulo_administrador.dashboard.index', [
            'programas_maestria' => $programas_maestria,
            'programas_doctorado' => $programas_doctorado,
            'ingreso_total' => $ingreso_total,
            'ingreso_inscripcion' => $ingreso_inscripcion,
            'ingreso_constancia' => $ingreso_constancia,
            'ingreso_matricula' => $ingreso_matricula,
            'pagos' => $pagos,
            'evaluados' => $evaluados,
            'admitidos' => $admitidos
        ]);
    }

    public function export_pdf()
    {
        $programas_maestria = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->where('programa.id_programa', 1) // 1 = Maestria
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();

        $programas_doctorado = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->where('programa.id_programa', 2) // 2 = Doctorado
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();


        $ingreso_total = Pago::sum('monto');
        $ingreso_inscripcion = Pago::where('estado', 3)->sum('monto');
        $ingreso_constancia = Pago::where('estado', 4)->sum('monto');

        $pagos = Pago::all();

        $data = [
            'programas_maestria' => $programas_maestria,
            'programas_doctorado' => $programas_doctorado,
            'ingreso_total' => $ingreso_total,
            'ingreso_inscripcion' => $ingreso_inscripcion,
            'ingreso_constancia' => $ingreso_constancia,
            'pagos' => $pagos
        ];

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isJavascriptEnabled', true);
        $options->set('isFontSubsettingEnabled', true);
        $pdf = new Dompdf($options);
        $pdf->loadHtml(View::make('modulo_administrador.dashboard.reporte', $data));
        $pdf->setPaper('a4', 'portrait');
        $pdf->render();

        // abrir el pdf
        return $pdf->stream('reporte.pdf');
    }

    public function export_evaluaciones_excel()
    {
        $fecha_actual = date("Ymd", strtotime(today()));
        $hora_actual = date("His", strtotime(now()));
        $nombre_archivo = 'report-evaluaciones-' . $fecha_actual . '-' . $hora_actual . '.xlsx';

        return Excel::download(new ExportData, $nombre_archivo);
    }
}

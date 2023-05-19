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

        // reportes ded inscritos del mes de febrero
        $inscritos_febrero_1 = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->whereMonth('inscripcion.fecha_inscripcion', 2)
            ->whereNotIn('inscripcion.id_mencion', [1, 25])
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();
        $inscritos_febrero_count_1 = $inscritos_febrero_1->sum('cantidad_mencion');
        $inscritos_febrero_2 = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->whereMonth('inscripcion.fecha_inscripcion', 2)
            ->where('inscripcion.id_mencion', 1)
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();
        $inscritos_febrero_count_2 = $inscritos_febrero_2->sum('cantidad_mencion');
        $inscritos_febrero_3 = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->whereMonth('inscripcion.fecha_inscripcion', 2)
            ->where('inscripcion.id_mencion', 25)
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();
        $inscritos_febrero_count_3 = $inscritos_febrero_3->sum('cantidad_mencion');

        // reportes ded inscritos del mes de marzo
        $inscritos_marzo_1 = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->whereMonth('inscripcion.fecha_inscripcion', 3)
            ->whereNotIn('inscripcion.id_mencion', [1, 25])
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();
        $inscritos_marzo_count_1 = $inscritos_marzo_1->sum('cantidad_mencion');
        $inscritos_marzo_2 = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->whereMonth('inscripcion.fecha_inscripcion', 3)
            ->where('inscripcion.id_mencion', 1)
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();
        $inscritos_marzo_count_2 = $inscritos_marzo_2->sum('cantidad_mencion');
        $inscritos_marzo_3 = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->whereMonth('inscripcion.fecha_inscripcion', 3)
            ->where('inscripcion.id_mencion', 25)
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();
        $inscritos_marzo_count_3 = $inscritos_marzo_3->sum('cantidad_mencion');

        // reportes ded inscritos del mes de abril
        $inscritos_abril_1 = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->whereMonth('inscripcion.fecha_inscripcion', 4)
            ->whereNotIn('inscripcion.id_mencion', [1, 25])
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();
        $inscritos_abril_count_1 = $inscritos_abril_1->sum('cantidad_mencion');
        $inscritos_abril_2 = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->whereMonth('inscripcion.fecha_inscripcion', 4)
            ->where('inscripcion.id_mencion', 1)
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();
        $inscritos_abril_count_2 = $inscritos_abril_2->sum('cantidad_mencion');
        $inscritos_abril_3 = Inscripcion::join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
            ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
            ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
            ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
            ->where('mencion.mencion_estado', 1)
            ->whereMonth('inscripcion.fecha_inscripcion', 4)
            ->where('inscripcion.id_mencion', 25)
            ->groupBy('inscripcion.id_mencion')
            ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
            ->get();
        $inscritos_abril_count_3 = $inscritos_abril_3->sum('cantidad_mencion');

        return view('modulo_administrador.dashboard.index', [
            'programas_maestria' => $programas_maestria,
            'programas_doctorado' => $programas_doctorado,
            'ingreso_total' => $ingreso_total,
            'ingreso_inscripcion' => $ingreso_inscripcion,
            'ingreso_constancia' => $ingreso_constancia,
            'ingreso_matricula' => $ingreso_matricula,
            'pagos' => $pagos,
            'evaluados' => $evaluados,
            'admitidos' => $admitidos, 
            'inscritos_febrero_count_1' => $inscritos_febrero_count_1,
            'inscritos_febrero_count_2' => $inscritos_febrero_count_2,
            'inscritos_febrero_count_3' => $inscritos_febrero_count_3,
            'inscritos_marzo_count_1' => $inscritos_marzo_count_1,
            'inscritos_marzo_count_2' => $inscritos_marzo_count_2,
            'inscritos_marzo_count_3' => $inscritos_marzo_count_3,
            'inscritos_abril_count_1' => $inscritos_abril_count_1,
            'inscritos_abril_count_2' => $inscritos_abril_count_2,
            'inscritos_abril_count_3' => $inscritos_abril_count_3,
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

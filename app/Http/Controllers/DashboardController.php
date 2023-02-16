<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inscripcion;
use App\Models\Mencion;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $programas = Inscripcion::join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                                ->select('subprograma.subprograma', 'mencion.mencion', 'programa.descripcion_programa', Inscripcion::raw('count(inscripcion.id_mencion) as cantidad_mencion'))
                                ->where('mencion.mencion_estado',1)
                                ->groupBy('inscripcion.id_mencion')
                                ->orderBy(Inscripcion::raw('count(inscripcion.id_mencion)'), 'DESC')
                                ->get();

        return view('modulo_administrador.dashboard.index', [
            'programas' => $programas
        ]);
    }
}

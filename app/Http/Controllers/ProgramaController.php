<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programa;
use App\Http\Controllers\Controller;
use App\Models\GrupoPrograma;
use App\Models\Mencion;
use App\Models\Sede;

class ProgramaController extends Controller
{
    public function index()
    {
        $pro = Programa::all();
        $sede = Sede::all();
        return view('modulo_administrador.Programa.index', compact('pro', 'sede'));
    }

    public function curso($mencion_id)
    {
        $mencion = Mencion::join('subprograma', 'subprograma.id_subprograma', '=', 'mencion.id_subprograma')
            ->join('programa', 'programa.id_programa', '=', 'subprograma.id_programa')
            ->where('id_mencion', $mencion_id)
            ->first();

        if($mencion->mencion == null){
            $titulo = $mencion->descripcion_programa . ' en ' . $mencion->subprograma;
        }else{
            $titulo = $mencion->descripcion_programa . ' en ' . $mencion->subprograma . ' con mención en ' . $mencion->mencion;
        }

        return view('modulo_administrador.Curso.index', compact('mencion_id', 'titulo'));
    }

    public function grupo($mencion_id)
    {
        $mencion = Mencion::join('subprograma', 'subprograma.id_subprograma', '=', 'mencion.id_subprograma')
            ->join('programa', 'programa.id_programa', '=', 'subprograma.id_programa')
            ->where('id_mencion', $mencion_id)
            ->first();

        if($mencion->mencion == null){
            $titulo = $mencion->descripcion_programa . ' en ' . $mencion->subprograma;
        }else{
            $titulo = $mencion->descripcion_programa . ' en ' . $mencion->subprograma . ' con mención en ' . $mencion->mencion;
        }

        return view('modulo_administrador.Programa.grupo', compact('mencion_id', 'titulo'));
    }

    public function detalle_grupo($id, $id_grupo_programa)
    {
        return view('modulo_administrador.Programa.detalle-grupo', [
            'id_mencion' => $id,
            'id_grupo_programa' => $id_grupo_programa
        ]);
    }
}

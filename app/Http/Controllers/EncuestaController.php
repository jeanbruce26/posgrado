<?php

namespace App\Http\Controllers;

use App\Models\EncuestaDetalle;
use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    public function index()
    {
        $data = EncuestaDetalle::join('encuesta','encuesta_detalle.encuesta_id','=','encuesta.encuesta_id')
                            ->select('encuesta_detalle.encuesta_id', EncuestaDetalle::raw('count(encuesta_detalle.encuesta_id) as cantidad'))
                            ->where('encuesta.encuesta_estado',1)
                            ->groupBy('encuesta_detalle.encuesta_id')
                            ->orderBy(EncuestaDetalle::raw('count(encuesta_detalle.encuesta_id)'), 'DESC')
                            ->take(10)->skip(0)->get();
        
        $count = [];

        foreach ($data as $item) {
            $count[] = ['label' => $item->encuesta->descripcion, 'data' => $item->cantidad];
        }

        if ($count == null) {
            $count[] = ['label' => 'No se encontro datos', 'data' => 0];
        }

        $data_encuesta = json_encode($count);

        // dd($data_encuesta);

        $encuesta_otros = EncuestaDetalle::where('encuesta_id', 8)->get();

        return view('modulo_administrador.Encuesta.index', [
            'data_encuesta' => $data_encuesta,
            'encuesta_otros' => $encuesta_otros
        ]);
    }
}

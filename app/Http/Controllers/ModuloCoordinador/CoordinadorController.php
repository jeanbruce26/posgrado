<?php

namespace App\Http\Controllers\ModuloCoordinador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}

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
}

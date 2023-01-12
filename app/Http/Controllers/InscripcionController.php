<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Expediente;
use Illuminate\Http\Request;


class InscripcionController extends Controller
{
    public function index()
    {
        return view('modulo_administrador.Inscripcion.index');
    }

    public function lista()
    {
        return view('modulo_administrador.Inscripcion.usuarios_lista');
    }
}

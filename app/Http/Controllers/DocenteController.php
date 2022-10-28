<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        return view('modulo_administrador.Usuario.Docente.index');
    }

}

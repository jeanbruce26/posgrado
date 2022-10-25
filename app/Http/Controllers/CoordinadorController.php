<?php

namespace App\Http\Controllers;

use App\Models\Coordinador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    public function index()
    {
        return view('modulo_administrador.Usuario.Coordinador.index');
    }

}

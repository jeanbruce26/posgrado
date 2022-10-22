<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EstadoCivil;

class EstadoCivilController extends Controller
{
    public function index()
    {
        $esta = EstadoCivil::orderBy('cod_est','ASC')->paginate(10);
        return view('modulo_administrador.EstadoCivil.index', compact('esta'));

    }
}

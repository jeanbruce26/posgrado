<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EstadoCivil;

class EstadoCivilController extends Controller
{
    public function index()
    {
        $esta = EstadoCivil::orderBy('cod_est','ASC')->paginate();
        return view('EstadoCivil.index', compact('esta'));

    }
}

<?php

namespace App\Http\Controllers\ModuloContable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContableController extends Controller
{
    public function index()
    {
        return view('modulo-contable.index');
    }

    public function inscripciones()
    {
        return view('modulo-contable.inscripcion');
    }
}

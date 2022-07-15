<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discapacidad;

class DiscapacidadController extends Controller
{
    public function index()
    {
        $disc = Discapacidad::orderBy('cod_disc','ASC')->paginate();
        return view('Discapacidad.index', compact('disc'));

    }
}

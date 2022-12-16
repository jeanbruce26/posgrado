<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programa;
use App\Http\Controllers\Controller;
use App\Models\Sede;

class ProgramaController extends Controller
{
    public function index()
    {
        $pro = Programa::all();
        $sede = Sede::all();
        return view('modulo_administrador.Programa.index', compact('pro', 'sede'));
    }
}

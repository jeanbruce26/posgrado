<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GradoAcademico;

class GradoAcademicoController extends Controller
{
    public function index()
    {
        $gra = GradoAcademico::orderBy('id_grado_academico','ASC')->paginate();
        return view('GradoAcademico.index', compact('gra'));
    }
}

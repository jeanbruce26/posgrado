<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Evaluacion;
use App\Http\Controllers\Controller;
use App\Models\Admitidos;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EvaluacionController extends Controller
{

    public function index()
    {
        //
    }

    public function admitidos()
    {
        return view('modulo_administrador.evaluacion.admitidos.index');
    }
}

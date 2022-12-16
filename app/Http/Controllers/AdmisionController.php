<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admision;

class AdmisionController extends Controller
{
    public function index()
    {
        return view('modulo_administrador.Admision.index');
    }
}

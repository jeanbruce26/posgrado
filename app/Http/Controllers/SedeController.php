<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sede;
use App\Http\Controllers\Controller;
use App\Models\Plan;

class SedeController extends Controller
{
    public function index()
    {
        return view('modulo_administrador.Sede.index');
    }
}

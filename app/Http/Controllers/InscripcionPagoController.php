<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscripcionPago;

class InscripcionPagoController extends Controller
{
    public function index()
    {
        return view('modulo_administrador.InscripcionPago.index');
    }

}

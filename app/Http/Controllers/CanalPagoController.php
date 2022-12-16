<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CanalPago;

class CanalPagoController extends Controller
{
    public function index()
    {
        return view('modulo_administrador.CanalPago.index');
    }
}

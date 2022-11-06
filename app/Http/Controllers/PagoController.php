<?php

namespace App\Http\Controllers;


use App\Models\Pago;
use App\Models\CanalPago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        return view('modulo_administrador.Pago.index');
    }
}

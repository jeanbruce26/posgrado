<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    public function index()
    {
        return view('modulo_administrador.Usuario.Trabajador.index');
    }

    public function perfil()
    {
        $tipo = 'admin';
        return view('modulo_administrador.Perfil.index', [
            'tipo' => $tipo
        ]);
    }
}

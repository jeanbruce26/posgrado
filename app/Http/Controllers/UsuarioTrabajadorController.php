<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioTrabajadorController extends Controller
{
    public function index()
    {
        return view('modulo_administrador.Usuario.Usuario.index');
    }
}

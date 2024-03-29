<?php

namespace App\Http\Controllers\ModuloInscripcion\Usuario;

use App\Models\Admision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioLoginController extends Controller
{
    protected $guard = 'usuarios';

    public function index()
    {
        $admision = Admision::where('estado',1)->first();
        return view('modulo_inscripcion.auth.usuario', compact('admision'));
    }

    public function logout(Request $request)
    {
        auth('usuarios')->logout();

        return redirect()->route('usuario.usuario.login');
    }
}

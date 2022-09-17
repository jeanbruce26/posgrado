<?php

namespace App\Http\Controllers;

use App\Models\Admision;
use Illuminate\Http\Request;

class UsuarioLoginController extends Controller
{
    protected $guard = 'usuarios';

    public function index()
    {
        $admision = Admision::where('estado',1)->first();
        return view('usuario.auth.usuario', compact('admision'));
    }

    public function logout(Request $request)
    {
        auth('usuarios')->logout();

        return redirect()->route('usuario.usuario.login');
    }
}

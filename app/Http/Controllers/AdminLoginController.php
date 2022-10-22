<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admision;

class AdminLoginController extends Controller
{
    public function administrador()
    {
        return view('modulo_administrador.dashboard.index');
    }

    public function login()
    {
        $admision = Admision::where('estado',1)->first();
        return view('modulo_administrador.Auth.login', compact('admision'));
    }

    public function logout()
    {
        auth('admin')->logout();

        return redirect()->route('admin.login');
    }
}

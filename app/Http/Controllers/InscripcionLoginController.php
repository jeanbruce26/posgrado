<?php

namespace App\Http\Controllers;

use App\Models\Admision;
use App\Models\InscripcionPago;
use App\Models\Pago;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class InscripcionLoginController extends Controller
{
    protected $guard = 'pagos';

    public function index()
    {
        $admision = Admision::where('estado',1)->first();
        return view('usuario.auth.login', compact('admision'));
    }

    public function logout(Request $request)
    {
        auth('pagos')->logout();

        return redirect()->route('usuario.login');
    }
}

<?php

namespace App\Http\Controllers\ModuloInscripcion\Inscripcion;

use App\Models\Admision;
use App\Models\InscripcionPago;
use App\Models\Pago;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InscripcionLoginController extends Controller
{
    protected $guard = 'pagos';

    public function index()
    {
        $admision = Admision::where('estado',1)->first();
        return view('modulo_inscripcion.auth.login', compact('admision'));
    }

    public function logout(Request $request)
    {
        auth('pagos')->logout();

        return redirect()->route('usuario.login');
    }
}

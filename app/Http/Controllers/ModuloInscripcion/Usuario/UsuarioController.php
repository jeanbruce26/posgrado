<?php

namespace App\Http\Controllers\ModuloInscripcion\Usuario;

use App\Models\Admision;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use App\Models\Inscripcion;
use App\Models\InscripcionPago;
use App\Models\Mencion;
use App\Models\Pago;
use App\Models\Persona;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('modulo_inscripcion.usuario.index');
    }

    public function create()
    {
        return view('modulo_inscripcion.usuario.create');
    }

    public function edit()
    {
        return view('modulo_inscripcion.usuario.update');
    }

    public function pagos()
    {
        return view('modulo_inscripcion.usuario.pagos');
    }

    public function pdf()
    {
        $pdf = Pdf::loadView('modulo_inscripcion.usuario.matricula');

        return $pdf->stream('archivo.pdf');
    }
}

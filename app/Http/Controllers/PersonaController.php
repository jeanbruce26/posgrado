<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\TipoDocumento;
use App\Models\Discapacidad;
use App\Models\EstadoCivil;
use App\Models\Universidad;
use App\Models\GradoAcademico;

class PersonaController extends Controller
{
    public function index()
    {
        return view('modulo_administrador.Persona.index');
    }
}

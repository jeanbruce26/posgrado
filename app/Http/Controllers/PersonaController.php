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
        $perso = Persona::orderBy('idpersona','ASC')->paginate();
        return view('Persona.index', compact('perso'));
    }

    public function create()
    {
        $tipodo= TipoDocumento::all();
        $tipodis= Discapacidad::all();
        $esta= EstadoCivil::all();
        $uni= Universidad::all();
        $gra= GradoAcademico::all();
        return view('Persona.create', compact('tipodo','tipodis','esta','uni','gra'));
    }

    public function store(){
        //
    }
}

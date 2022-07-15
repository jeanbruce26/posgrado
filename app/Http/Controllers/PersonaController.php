<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    public function index()
    {
        $perso = Persona::orderBy('idpersona','ASC')->paginate();
        return view('Persona.index', compact('perso'));

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UbigeoPersona;

class UbigeoPersonaController extends Controller
{
    public function index()
    {
        $ubip = UbigeoPersona::orderBy('cod_ubi_pers','ASC')->paginate();
        return view('UbigeoPersona.index', compact('ubip'));
    }
}

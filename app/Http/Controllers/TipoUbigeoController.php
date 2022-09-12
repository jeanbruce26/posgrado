<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoUbigeo;

class TipoUbigeoController extends Controller
{
    public function index()
    {
        $ti = TipoUbigeo::orderBy('cod_tipo','ASC')->paginate(10);
        return view('TipoUbigeo.index', compact('ti'));
    }
}

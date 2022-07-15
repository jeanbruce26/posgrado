<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoDocumento;

class TipoDocumentoController extends Controller
{

    public function index()
    {
    $tipo = TipoDocumento::orderBy('cod_tipo','ASC')->paginate();
        return view('TipoDocumento.index', compact('tipo'));

}
}

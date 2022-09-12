<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoDocumento;

class TipoDocumentoController extends Controller
{

    public function index()
    {
    $tipo = TipoDocumento::orderBy('id_tipo_doc','ASC')->paginate(10);
        return view('TipoDocumento.index', compact('tipo'));

}
}

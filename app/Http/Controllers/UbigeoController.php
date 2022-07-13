<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ubigeo;

class UbigeoController extends Controller
{
    public function index()
    {
        $ubi = Ubigeo::orderBy('cod_ubi','ASC')->paginate();
        return view('Ubigeo.index', compact('ubi'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Universidad;

class UniversidadController extends Controller
{
   public function index()
    {
        $uni = Universidad::orderBy('cod_uni','ASC')->paginate();
        return view('Universidad.index', compact('uni'));
    }
}

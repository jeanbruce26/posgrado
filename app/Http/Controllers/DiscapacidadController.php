<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discapacidad;

class DiscapacidadController extends Controller
{
    public function index()
    {
        $disc = Discapacidad::orderBy('cod_disc','ASC')->paginate(10);
        return view('modulo_administrador.Discapacidad.index', compact('disc'));

    }

    public function create()
    {
        $disca = Discapacidad::all();
        return view('Discapacidad.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'discapacidad'  =>  'required|max:45',
        ]);
        Discapacidad::create($request->all());
        return redirect()->route('Discapacidad.index');
    }

    public function edit($id)
    {
        $disca = Discapacidad::find($id);
        return view('modulo_administrador.Discapacidad.edit')->with('disca',$disca);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'discapacidad'  =>  'required|max:45',
        ]);
        $disca = Discapacidad::find($id);
        $disca ->update($request->all());
        return redirect()->route('Discapacidad.index');
    }

}

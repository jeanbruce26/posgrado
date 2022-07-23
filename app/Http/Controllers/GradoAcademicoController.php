<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GradoAcademico;

class GradoAcademicoController extends Controller
{
    public function index()
    {
        $gra = GradoAcademico::orderBy('id_grado_academico','ASC')->paginate();
        return view('GradoAcademico.index', compact('gra'));
    }

    public function create()
    {
        $gradoAca = GradoAcademico::all();
        return view('GradoAcademico.create', compact('gradoAca'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_grado'  =>  'required|max:45',
        ]);
        GradoAcademico::create($request->all());
        return redirect()->route('GradoAcademico.index');
    }

    public function edit($id)
    {
        $gradoAca = GradoAcademico::find($id);
        return view('GradoAcademico.edit')->with('gradoAca',$gradoAca);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_grado'  =>  'required|max:45',
        ]);
        $gradoAca = GradoAcademico::find($id);
        $gradoAca ->update($request->all());
        return redirect()->route('GradoAcademico.index');
    }
}

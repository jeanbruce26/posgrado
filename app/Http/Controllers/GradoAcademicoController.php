<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GradoAcademico;

class GradoAcademicoController extends Controller
{
    public function index()
    {
        $grado = GradoAcademico::orderBy('id_grado_academico','ASC')->get();
        return view('modulo_administrador.GradoAcademico.index', compact('grado'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_grado'  =>  'required|string|max:45',
        ]);

        $grado = GradoAcademico::create([
            "nom_grado" => $request->nom_grado
        ]);
        
        session()->flash('new', 'Grado Académico Creado Satisfactoriamente!');
        return redirect()->route('GradoAcademico.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_grado'  =>  'required|string|max:45',
        ]);

        $grado = GradoAcademico::find($id);
        $grado ->update($request->all());

        if($grado->save()){
            return redirect(to: '/GradoAcademico')->with('edit', 'Grado Académico Actualizado Satisfactoriamente');
        }else{
            exit();
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\TipoDocumento;
use App\Models\Discapacidad;
use App\Models\EstadoCivil;
use App\Models\Universidad;
use App\Models\GradoAcademico;

class PersonaController extends Controller
{
    public function index()
    {
        $perso = Persona::all();
        $disca = Discapacidad::all();
        $estCivil = EstadoCivil::all();
        $uni = Universidad::all();
        $gradoAca = GradoAcademico::all();
        return view('Persona.index', compact('perso', 'disca', 'estCivil', 'uni', 'gradoAca'));
    }

    public function create()
    {
        $tipodo= TipoDocumento::all();
        $tipodis= Discapacidad::all();
        $esta= EstadoCivil::all();
        $uni= Universidad::all();
        $gra= GradoAcademico::all();
        return view('Persona.create', compact('tipodo','tipodis','esta','uni','gra'));
    }

    public function store(){
        //
    }

    public function update(Request $request, $id)
    {

        // dd($request->all());
        $request->validate([
            'num_doc'  =>  'required|min:8',
            'apell_pater'  =>  'required|max:45',
            'apell_mater'  =>  'required|max:45',
            'nombres'  =>  'required|max:45',
            'direccion'  =>  'required|max:45',
            'celular1'  =>  'required|numeric',
            'celular2'  =>  'nullable|numeric',
            'sexo'  =>  'required',
            'fecha_naci'  =>  'required|date',
            'email'  =>  'required',
            'email2'  =>  'nullable',
            'año_egreso'  =>  'required|numeric',
            'centro_trab'  =>  'required',
            'tipo_doc_cod_tipo '  =>  'nullable|numeric',
            'discapacidad_cod_disc'  =>  'nullable|numeric',
            'est_civil_cod_est'  =>  'required|numeric',
            'univer_cod_uni'  =>  'required|numeric',
            'id_grado_academico'  =>  'required|numeric',
            'especialidad'  =>  'nullable|max:45',
            'pais_extra'  =>  'nullable|max:45',
        ]);
        
        $perso = Persona::find($id);
        $perso->update($request->all());
        if($perso->save()){
            return redirect(to: '/Persona')->with('edit', '¡Persona Actualizada Satisfactoriamente!');
        }else{
            exit();
        }
    }

    public function show($id)
    {
        
    }
}

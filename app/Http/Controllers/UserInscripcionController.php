<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Discapacidad;
use App\Models\Distrito;
use App\Models\EstadoCivil;
use App\Models\GradoAcademico;
use App\Models\TipoDocumento;
use App\Models\Universidad;
use App\Models\Expediente;
use App\Models\Persona;
use App\Models\Provincia;
use App\Models\UbigeoPersona;
use Illuminate\Http\Request;

class UserInscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_doc = TipoDocumento::all();
        $tipo_dis = Discapacidad::all();
        $estado_civil = EstadoCivil::all();
        $universidad = Universidad::all();
        $grado = GradoAcademico::all();
        $expediente = Expediente::all();
        $departamento = Departamento::all();
        return view('user/inscripcion.formulario1', compact('tipo_doc','tipo_dis','estado_civil','universidad','grado','expediente','departamento'));
    }

    // public function provincias(Request $request){
    //     if(isset($request->texto)){
    //         $provincias = Provincia::whereId_departamento($request->texto)->get();
    //         return response()->json(
    //             [
    //                 'lista' => $provincias,
    //                 'success' => true
    //             ]
    //             );
    //     }else{
    //         return response()->json(
    //             [
    //                 'success' => false
    //             ]
    //             );

    //     }
    // }

    public function index2()
    {
        return view('user/inscripcion.formulario2');
    }

    public function index3()
    {
        return view('user/inscripcion.formulario3');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'num_doc'  =>  'required|max:10',
            'apell_pater'  =>  'required',
            'apell_mater'  =>  'required',
            'nombres'  =>  'required|max:50',
            'direccion'  =>  'required|max:50',
            'celular1'  =>  'required|max:9',
            'celular2'  =>  'max:9',
            'sexo'  =>  'required',
            'fecha_naci'  =>  'required',
            'email'  =>  'required|max:50',
            'email2'  =>  'max:50',
            'año_egreso'  =>  'required|max:50',
            'centro_trab'  =>  'required|max:50',
            'tipo_doc_cod_tipo'  =>  'required',
            'discapacidad_cod_disc'  =>  '',
            'est_civil_cod_est'  =>  'required',
            'univer_cod_uni'  =>  'required',
            'id_grado_academico'  =>  'required',
            'especialidad'  =>  'max:50',
            'pais_extra'  =>  'max:50',
        ]);
        $persona = Persona::create($request->all());

        $idpersona = $persona->idpersona;

        $input = $request->all();
        
        for ($i = 1; $i <= 2; $i++){
            $dato = UbigeoPersona::create([
                "id_distrito" => $input['id_distrito'],
                "tipo_ubigeo_cod_tipo" => $i,
                "persona_idpersona" => 'idpersona',
            ]);
        }

        return view('user/inscripcion.formulario2', compact('persona'));
    }

    public function store2(Request $request)
    {
        //
    }

    public function store3(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

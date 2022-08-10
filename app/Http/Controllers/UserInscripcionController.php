<?php

namespace App\Http\Controllers;

use App\Models\Admision;
use App\Models\Discapacidad;
use App\Models\Distrito;
use App\Models\EstadoCivil;
use App\Models\GradoAcademico;
use App\Models\TipoDocumento;
use App\Models\Universidad;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use App\Models\IngresoPago;
use App\Models\Inscripcion;
use App\Models\Persona;
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
        // $tipo_doc = TipoDocumento::all();
        // $tipo_dis = Discapacidad::all();
        // $estado_civil = EstadoCivil::all();
        // $universidad = Universidad::all();
        // $grado = GradoAcademico::all();
        // $expediente = Expediente::all();
        // return view('user/inscripcion.create', compact('tipo_doc','tipo_dis','estado_civil','universidad','grado','expediente'));
    }

    public function index2($idpersona)
    {
        // return view('user/inscripcion.formulario2', compact('idpersona'));
    }

    public function index3($id_inscripcion)
    {
        // $expediente = Expediente::all();
        // return view('user/inscripcion.formulario3', compact('id_inscripcion', 'expediente'));
    }

    public function index4()
    {
        return view('user.inscripcion.inscripcion');
    }

    public function check(Request $request)
    {
        // dd($request);

        $request->validate([
            'check' => ['required']
        ]);

        return view('user.inscripcion.inscripcion');
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
        // // dd($request);
        // $expediente = Expediente::all();
        // foreach($expediente as $item){
        // $request->validate([
        //         ("nom_exped".$item->cod_exp)  =>  'mimes:pdf|max:20240'
        // ]);
        // }
        // $request->validate([
        //     'num_doc'  =>  'required|max:10',
        //     'apell_pater'  =>  'required',
        //     'apell_mater'  =>  'required',
        //     'nombres'  =>  'required|max:50',
        //     'direccion'  =>  'required|max:50',
        //     'celular1'  =>  'required|max:9',
        //     'celular2'  =>  'max:9',
        //     'sexo'  =>  'required',
        //     'fecha_naci'  =>  'required',
        //     'email'  =>  'required|max:50',
        //     'email2'  =>  'max:50',
        //     'año_egreso'  =>  'required|max:50',
        //     'centro_trab'  =>  'required|max:50',
        //     'tipo_doc_cod_tipo'  =>  'required',
        //     'discapacidad_cod_disc'  =>  'numeric',
        //     'est_civil_cod_est'  =>  'required',
        //     'univer_cod_uni'  =>  'required',
        //     'id_grado_academico'  =>  'required',
        //     'especialidad'  =>  'max:50',
        //     'pais_extra'  =>  'max:50',
        //     'id_mencion'  =>  'required',
        //     'num_opera'  =>  'required',
        //     'monto'  =>  'required',
        //     'fecha'  =>  'required',
        //     'vaucher'  =>  'required|mimes:pdf,jpg,jpeg,png|max:10240',
        //     'nom_exped2'  =>  'required|mimes:pdf|max:20240',
        // ]);

        // //FORMULARIO 1

        // $persona = Persona::create([
        //     "num_doc" => $request->num_doc,
        //     "apell_pater" => $request->apell_pater,
        //     "apell_mater" => $request->apell_mater,
        //     "nombres" => $request->nombres,
        //     "direccion" => $request->direccion,
        //     "celular1" => $request->celular1,
        //     "celular2" => $request->celular2,
        //     "sexo" => $request->sexo,
        //     "fecha_naci" => $request->fecha_naci,
        //     "email" => $request->email,
        //     "email2" => $request->email2,
        //     "año_egreso" => $request->año_egreso,
        //     "centro_trab" => $request->centro_trab,
        //     "tipo_doc_cod_tipo" => $request->tipo_doc_cod_tipo,
        //     "discapacidad_cod_disc" => $request->discapacidad_cod_disc,
        //     "est_civil_cod_est " => $request->est_civil_cod_est,
        //     "univer_cod_uni" => $request->univer_cod_uni,
        //     "id_grado_academico" => $request->id_grado_academico,
        //     "especialidad" => $request->especialidad,
        // ]);

        // dd($persona);

        // $idpersona = $persona->idpersona;

        // $input = $request->all();
        
        // for ($i = 1; $i <= 2; $i++){
        //     $v = "id_distrito".$i;
        //     $ubigeo = Distrito::select('ubigeo')->where('id',$input[$v])->get();
        //     foreach($ubigeo as $item){
        //         $ubi = $item->ubigeo;
        //     }
        //     UbigeoPersona::create([
        //         "id_distrito" => $input[$v],
        //         "tipo_ubigeo_cod_tipo" => $i,
        //         "persona_idpersona" => $idpersona,
        //         "ubigeo" => $ubi,
        //     ]);
        // }

        // //FORMULARIO 2

        // $admision = 1;
        // $estado = "Activo";

        // $inscripcion = Inscripcion::create([
        //     "persona_idpersona" => $idpersona,
        //     "estado" => $estado,
        //     "admision_cod_admi" => $admision,
        //     "id_mencion" => $input['id_mencion'],
        // ]);

        // $id_inscripcion = $inscripcion->id_inscripcion;

        // $admision2 = Admision::where('cod_admi',1)->get();
        // foreach($admision2 as $item){
        //     $admi = $item->admision;
        // }

        // $data = $request->file('vaucher');
        // $data = $filename = "voucher".".".$data->extension();
        // $request->vaucher->move(public_path($admi.'/'.$id_inscripcion), $filename);

        // IngresoPago::create([
        //     "num_opera" => $input['num_opera'],
        //     "monto" => $input['monto'],
        //     "fecha" => $input['fecha'],
        //     "id_inscripcion" => $id_inscripcion,
        //     "vaucher" => $filename,
        // ]);

        // //FORMULARIO 3

        // $estadoExpediente = "Enviado";

        // $count = Expediente::count();

        // for($i = 1; $i <= $count; $i++){
        //     $expe = Expediente::where('cod_exp',$i)->get();
        //     foreach($expe as $item){
        //         $nombreExpediente = $item->tipo_doc;
        //         $cod = $item->cod_exp;
        //     }

        //     $admision3 = Admision::where('cod_admi',1)->get();
        //     foreach($admision3 as $item){
        //         $admi = $item->admision;
        //     }

        //     $name = 'nom_exped'.$cod;

        //     $data = $request->file('nom_exped'.$cod);
        //     if($data != null){
        //         $data = $filename = $nombreExpediente.".".$data->extension();
        //         $request->$name->move(public_path($admi.'/'.$id_inscripcion), $filename);

        //         ExpedienteInscripcion::create([
        //             "nom_exped" => $filename,
        //             "estado" => $estadoExpediente,
        //             "expediente_cod_exp" => $i,
        //             "id_inscripcion" => $id_inscripcion,
        //         ]);
        //     }
        // }

        // return redirect()->route('user');

        // // return redirect()->route('inscripcion.index2', [$persona->idpersona]);
    }

    public function store2(Request $request)
    {
        // $request->validate([
        //     'id_mencion'  =>  'required',
        //     'num_opera'  =>  'required',
        //     'monto'  =>  'required',
        //     'fecha'  =>  'required',
        //     'vaucher'  =>  'required|mimes:pdf,jpg,jpeg,png|max:10240',
        // ]);

        // $input = $request->all();   
        // $admision = 1;
        // $estado = "Activo";

        // $inscripcion = Inscripcion::create([
        //     "persona_idpersona" => $input['persona_idpersona'],
        //     "estado" => $estado,
        //     "admision_cod_admi" => $admision,
        //     "id_mencion" => $input['id_mencion'],
        // ]);

        // $id_inscripcion = $inscripcion->id_inscripcion;

        // $admision = Admision::where('cod_admi',1)->get();
        // foreach($admision as $item){
        //     $admi = $item->admision;
        // }

        // $data = $request->file('vaucher');
        // $data = $filename = "voucher".".".$data->extension();
        // $request->vaucher->move(public_path($admi.'/'.$id_inscripcion), $filename);

        // $ingre_pago = IngresoPago::create([
        //     "num_opera" => $input['num_opera'],
        //     "monto" => $input['monto'],
        //     "fecha" => $input['fecha'],
        //     "id_inscripcion" => $id_inscripcion,
        //     "vaucher" => $filename,
        // ]);

        // // return redirect()->route('inscripcion.index3', [$inscripcion->id_inscripcion]);
    }

    public function store3(Request $request)
    {
        // $expediente = Expediente::all();
        // foreach($expediente as $item){
        // $request->validate([
        //         ("nom_exped".$item->cod_exp)  =>  'mimes:pdf|max:20240'
        // ]);
        // }

        // $input = $request->all(); 

        // $estado = "Enviado";

        // $count = Expediente::count();

        // for($i = 1; $i <= $count; $i++){
        //     $expe = Expediente::where('cod_exp',$i)->get();
        //     foreach($expe as $item){
        //         $nombreExpediente = $item->tipo_doc;
        //         $cod = $item->cod_exp;
        //     }

        //     $admision = Admision::where('cod_admi',1)->get();
        //     foreach($admision as $item){
        //         $admi = $item->admision;
        //     }

        //     $name = 'nom_exped'.$cod;

        //     $data = $request->file('nom_exped'.$cod);
        //     $data = $filename = $nombreExpediente.".".$data->extension();
        //     $request->$name->move(public_path($admi.'/'.$input['id_inscripcion']), $filename);

        //     $expe_ins = ExpedienteInscripcion::create([
        //         "nom_exped" => $filename,
        //         "estado" => $estado,
        //         "expediente_cod_exp" => $i,
        //         "id_inscripcion" => $input['id_inscripcion'],
        //     ]);
        // }

        // return redirect()->route('user');
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

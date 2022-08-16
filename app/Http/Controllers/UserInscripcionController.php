<?php

namespace App\Http\Controllers;

use App\Models\Admision;
use App\Models\ConceptoPago;
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
use App\Models\InscripcionPago;
use App\Models\Mencion;
use App\Models\Pago;
use App\Models\Persona;
use App\Models\UbigeoPersona;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UserInscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.inscripcion.terminos-condiciones');
    }

    public function check(Request $request)
    {
        // $request->validate([
        //     'check'  =>  'required',
        // ]);

        if(!$request->check){
            return back()->with('mensaje','Acepte los Terminos y Condiciones');
        }

        return redirect()->route('inscripcion.pagos');
    }

    public function index2()
    {
        // return view('user/inscripcion.formulario2', compact('idpersona'));
        $concepto = ConceptoPago::all();
        $tipo_doc = TipoDocumento::all();
        $pago = null;
        $concepto_id = null;
        $tipodoc_id = null;
        $doc = null;
        return view('user.inscripcion.pagos', compact('concepto', 'tipo_doc', 'pago', 'concepto_id', 'tipodoc_id', 'doc'));
    }

    public function mostrarPago(Request $request)
    {
        $request->validate([
            'tipo_documento' => ['required', 'numeric'],
            'numero_documento' => ['required', 'numeric'],
            'concepto_pago' => ['required', 'numeric'],
        ]);
        if($request->numero_documento != auth('pagos')->user()->dni){
            return back()->with('mensaje-dni','El dni ingresado no puede ser buscado o no lo pertenece.');
        }
        $concepto = ConceptoPago::all();
        $concepto_id = $request->concepto_pago;
        $tipo_doc = TipoDocumento::all();
        $tipodoc_id = $request->tipo_documento;
        $doc = $request->numero_documento;
        $pago = Pago::where('dni',$request->numero_documento)->where('estado',1)->get();
        return view('user.inscripcion.pagos', compact('concepto', 'tipo_doc', 'pago', 'concepto_id', 'tipodoc_id', 'doc'));
    }

    public function guardarPago(Request $request)
    {
        if(!$request->seleccionar){
            return back()->with('mensaje-seleccionar','Debe seleccionar su pago, para continuar con su inscripcion.');
        }

        $admi = Admision::where('estado',1)->get();
        foreach($admi as $item){
            $admision = $item->cod_admi;
        }
        
        $inscripcion = Inscripcion::create([
            "estado" => 'Activo',
            "admision_cod_admi" => $admision,
        ]);

        foreach($request->seleccionar as $key=>$name){

            $inscripcion_pago = InscripcionPago::create([
                "pago_id" => $request->seleccionar[$key],
                "inscripcion_id" => $inscripcion->id_inscripcion,
                "concepto_pago_id" => $request->concepto_id,
            ]);

            $pago = Pago::find($request->seleccionar[$key]);
            $pago->estado = 2;
            $pago->save();
        }
        
        return redirect()->route('inscripcion.inscripcion', [$inscripcion->id_inscripcion]);
    }

    public function inscripcion($id_inscripcion)
    {
        $tipo_doc = TipoDocumento::all();
        $tipo_dis = Discapacidad::all();
        $estado_civil = EstadoCivil::all();
        $universidad = Universidad::all();
        $grado = GradoAcademico::all();
        $expediente = Expediente::all();
        return view('user/inscripcion.create', compact('tipo_doc','tipo_dis','estado_civil','universidad','grado','expediente','id_inscripcion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("America/Lima");
        // dd($final);
        $request->validate([
            'check'  =>  'required'
        ]);
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
        //     'check'  =>  'required',
        //     'nom_exped2'  =>  'required|mimes:pdf|max:20240',
        // ]);

        //FORMULARIO 1

        $persona = Persona::create([
            "num_doc" => $request->num_doc,
            "apell_pater" => $request->apell_pater,
            "apell_mater" => $request->apell_mater,
            "nombres" => $request->nombres,
            "direccion" => $request->direccion,
            "celular1" => $request->celular1,
            "celular2" => $request->celular2,
            "sexo" => $request->sexo,
            "fecha_naci" => $request->fecha_naci,
            "email" => $request->email,
            "email2" => $request->email2,
            "año_egreso" => $request->año_egreso,
            "centro_trab" => $request->centro_trab,
            "tipo_doc_cod_tipo" => $request->tipo_doc_cod_tipo,
            "discapacidad_cod_disc" => $request->discapacidad_cod_disc,
            "est_civil_cod_est" => $request->est_civil_cod_est,
            "univer_cod_uni" => $request->univer_cod_uni,
            "id_grado_academico" => $request->id_grado_academico,
            "especialidad" => $request->especialidad,
        ]);

        $idpersona = $persona->idpersona;

        $input = $request->all();
        
        for ($i = 1; $i <= 2; $i++){
            $v = "id_distrito".$i;
            $ubigeo = Distrito::select('ubigeo')->where('id',$input[$v])->get();
            foreach($ubigeo as $item){
                $ubi = $item->ubigeo;
            }
            UbigeoPersona::create([
                "id_distrito" => $input[$v],
                "tipo_ubigeo_cod_tipo" => $i,
                "persona_idpersona" => $idpersona,
                "ubigeo" => $ubi,
            ]);
        }

        $id_inscripcion = $request->id_inscripcion;

        $inscripcion = Inscripcion::find($id_inscripcion);
        $inscripcion->persona_idpersona = $idpersona;
        $inscripcion->id_mencion = $input['id_mencion'];
        $inscripcion->save();

        //FORMULARIO 3

        $estadoExpediente = "Enviado";

        $count = Expediente::count();

        for($i = 1; $i <= $count; $i++){
            $expe = Expediente::where('cod_exp',$i)->get();
            foreach($expe as $item){
                $nombreExpediente = $item->tipo_doc;
                $cod = $item->cod_exp;
            }

            $admision3 = Admision::where('estado',1)->get();
            foreach($admision3 as $item){
                $admi = $item->admision;
            }

            $name = 'nom_exped'.$cod;

            $data = $request->file('nom_exped'.$cod);
            if($data != null){
                $data = $filename = $nombreExpediente.".".$data->extension();
                $request->$name->move(public_path($admi.'/'.$id_inscripcion.'/'), $filename);

                ExpedienteInscripcion::create([
                    "nom_exped" => $filename,
                    "estado" => $estadoExpediente,
                    "expediente_cod_exp" => $i,
                    "id_inscripcion" => $id_inscripcion,
                ]);
            }
        }
        $montoTotal=0;
        $inscripcion_pago = InscripcionPago::where('inscripcion_id',$id_inscripcion)->get();
        foreach($inscripcion_pago as $item){
            $pago_id = $item->pago_id;
            $pago = Pago::find($pago_id);
            $pago->estado = 3;
            $pago->save();

            $montoTotal = $montoTotal + $item->pago->monto;
        }

        $fecha_actual = now();
        $mencion = Mencion::where('id_mencion',$request->id_mencion)->get();
        $admisionn = Admision::where('estado',1)->get();
        $inscrip = Inscripcion::where('id_inscripcion',$id_inscripcion)->get();
        $tiempo = 6;
        $valor = '+ '.intval($tiempo).' month';
        $final = date('j-m-Y',strtotime($request->fecha_inicio.$valor));

        $data = [ 
            'persona' => $persona,
            'fecha_actual' => $fecha_actual,
            'mencion' => $mencion,
            'admisionn' => $admisionn,
            'inscripcion_pago' => $inscripcion_pago,
            'inscrip' => $inscrip,
            'montoTotal' => $montoTotal,
            'final' => $final
        ];

        $nombre_pdf = 'FICHA_INSCRIPCION.pdf';
        $pdf = PDF::loadView('user.inscripcion.reporte-pdf', $data)->save(public_path($admi.'/'.$id_inscripcion.'/'). $nombre_pdf);
        PDF::loadView('user.inscripcion.reporte-pdf', $data)->stream($nombre_pdf);

        $ins = Inscripcion::find($id_inscripcion);
        $ins->inscripcion = $nombre_pdf;
        $ins->save();

        auth('pagos')->logout();

        return redirect()->route('login');
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

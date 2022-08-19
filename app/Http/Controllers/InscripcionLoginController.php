<?php

namespace App\Http\Controllers;

use App\Models\Admision;
use App\Models\InscripcionPago;
use App\Models\Pago;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class InscripcionLoginController extends Controller
{
    protected $guard = 'pagos';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admision = Admision::where('estado',1)->first();
        return view('user.auth.validacion', compact('admision'));
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
        if($request->tipo_documento == 1){
            $request->validate([
                'documento'  =>  'required|numeric|digits:8',
                'tipo_documento'  =>  'required|numeric',
                'nro_operacion'  =>  'required|numeric',
            ]);
        }else{
            $request->validate([
                'documento'  =>  'required|numeric|digits:9',
                'tipo_documento'  =>  'required|numeric',
                'nro_operacion'  =>  'required|numeric',
            ]);
        }
        $request->validate([
            'tipo_documento'  =>  'required|numeric',
            'nro_operacion'  =>  'required|numeric',
        ]);
        
        // $pago = Pago::where('dni',$request->dni)->where('nro_operacion',$request->nro_operacion)->where('estado',1)->orWhere('estado',2)->first();
        $pago = Pago::where('dni',$request->documento)->where('nro_operacion',$request->nro_operacion)->first();
        // dd($pago);
        if(!$pago){
            return back()->with('mensaje','Credenciales incorrectas');
        }

        if($pago->estado == 1){
            auth('pagos')->login($pago);
            return redirect()->route('inscripcion');
        }else if($pago->estado == 2){
            $inscripcion = InscripcionPago::join('pago','inscripcion_pago.pago_id','=','pago.pago_id')->where('pago.dni',$request->documento )->where('pago.nro_operacion',$request->nro_operacion)->where('pago.estado',2)->get();
            foreach($inscripcion as $item){
                $id_inscripcion = $item->inscripcion_id;
            }
            auth('pagos')->login($pago);
            return redirect()->route('inscripcion.inscripcion', [$id_inscripcion]);
        }else if($pago->estado == 3){
            return back()->with('mensaje','Usted ya no puede realizar una inscripción');
        }

    }

    public function logout(Request $request)
    {
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

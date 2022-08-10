<?php

namespace App\Http\Controllers;

use App\Models\Pago;
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
        return view('user.auth.validacion');
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
            'dni'  =>  'required|numeric',
            'nro_operacion'  =>  'required|numeric',
        ]);

        $pago = Pago::where('dni',$request->dni)->where('nro_operacion',$request->nro_operacion)->where('estado',1)->first();

        if(!$pago){
            return back()->with('mensaje','Credenciales incorrectas');
        }else{
            auth('pagos')->login($pago);
        }

        // if(!){
        //     return back()->with('mensaje','Credenciales incorrectas');
        // }

        return redirect()->route('inscripcion');
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

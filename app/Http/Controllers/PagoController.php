<?php

namespace App\Http\Controllers;

use App\Models\CanalPago;
use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\TipoPago;
use App\Models\ConceptoPago;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pago = Pago::orderBy('pago_id','ASC')->paginate(10);
        return view('Pago.index', compact('pago'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $canal = CanalPago::all();
        return view('Pago.create', compact('canal'));
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
            'dni'  =>  'required|min:8',
            'nro_operacion'  =>  'required|numeric',
            'monto'  =>  'required|numeric',
            'fecha_pago'  =>  'required|date',
            'estado'  =>  'required|numeric',
            'canal_pago_id'  =>  'required|numeric',
        ]);
        Pago::create($request->all());
        return redirect()->route('Pago.index');
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
        $pago = Pago::find($id);
        $canal = CanalPago::all();
        return view('Pago.edit', compact('canal','pago'))->with('pago',$pago);
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
        $request->validate([
            'dni'  =>  'required|min:8',
            'nro_operacion'  =>  'required|numeric',
            'monto'  =>  'required|numeric',
            'fecha_pago'  =>  'required|date',
            'estado'  =>  'required|numeric',
            'canal_pago_id'  =>  'required|numeric',
        ]);
        $pago = Pago::find($id);
        $pago ->update($request->all());
        return redirect()->route('Pago.index');
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

<?php

namespace App\Http\Controllers;

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
        $pag = Pago::orderBy('cod_pago','ASC')->paginate();
        return view('Pago.index', compact('pag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoPago = TipoPago::all();
        $concepPago = ConceptoPago::all();
        return view('Pago.create', compact('tipoPago', 'concepPago'));
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
            'tipo_pago_cod_tipo_pago'  =>  'required|max:11',
            'concep_pago_cod_concep'  =>  'required|max:11',
            'monto'  =>  'required|max:13',
            'fecha_pago'  =>  'required',
            'dni'  =>  'required|max:9',
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
        $tipoPago = TipoPago::all();
        $concepPago = ConceptoPago::all();
        return view('Pago.edit', compact('tipoPago','concepPago','pago'))->with('pago',$pago);
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
            'tipo_pago_cod_tipo_pago'  =>  'required|max:11',
            'concep_pago_cod_concep'  =>  'required|max:11',
            'monto'  =>  'required|max:13',
            'fecha_pago'  =>  'required',
            'dni'  =>  'required|max:9',
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConceptoPago;

class ConceptoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conPago = ConceptoPago::orderBy('concepto_id','ASC')->paginate();
        return view('ConceptoPago.index', compact('conPago'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ConceptoPago.create');
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
            'concepto'  =>  'required|max:45',
            'monto'  =>  'required|numeric',
            'estado'  =>  'required|max:11',
        ]);
        ConceptoPago::create($request->all());
        return redirect()->route('ConceptoPago.index');
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
        $concepPago = ConceptoPago::find($id);
        return view('ConceptoPago.edit')->with('concepPago',$concepPago);
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
            'concepto'  =>  'required|max:45',
            'monto'  =>  'required|numeric',
            'estado'  =>  'required|numeric',
        ]);
        $concepPago = ConceptoPago::find($id);
        $concepPago ->update($request->all());
        return redirect()->route('ConceptoPago.index');
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

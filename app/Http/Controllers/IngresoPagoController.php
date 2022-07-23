<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IngresoPago;
use App\Models\Inscripcion;

class IngresoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingrePago = IngresoPago::orderBy('cod_ingre','ASC')->paginate();
        return view('IngresoPago.index', compact('ingrePago'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insc = Inscripcion::all();
        return view('IngresoPago.create', compact('insc'));
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
            'num_opera'  =>  'required|max:45',
            'monto'  =>  'required|max:13',
            'fecha'  =>  'required',
            'id_inscripcion'  =>  'required',
        ]);
        IngresoPago::create($request->all());
        return redirect()->route('IngresoPago.index');
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
        $ingPago = IngresoPago::find($id);
        $insc = Inscripcion::all();
        return view('IngresoPago.edit', compact('insc','ingPago'))->with('ingPago',$ingPago);
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
            'num_opera'  =>  'required|max:45',
            'monto'  =>  'required|max:13',
            'fecha'  =>  'required',
            'id_inscripcion'  =>  'required',
        ]);
        $ingPago = IngresoPago::find($id);
        $ingPago ->update($request->all());
        return redirect()->route('IngresoPago.index');
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

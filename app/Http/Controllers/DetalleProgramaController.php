<?php

namespace App\Http\Controllers;

use App\Models\DetallePrograma;
use App\Models\Plan;
use App\Models\Programa;
use App\Models\Sede;
use Illuminate\Http\Request;

class DetalleProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detpro = DetallePrograma::orderBy('id_detalle_programa','ASC')->paginate();
        return view('DetallePrograma.index', compact('detpro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pro = Programa::all();
        $plan = Plan::all();
        $sede = Sede::all();
        return view('DetallePrograma.create', compact('pro','plan','sede'));
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
            'id_programa'  =>  'required',
            'cod_detalle_programa'  =>  'required|max:10',
            'des_detalle_programa'  =>  'required|max:50',
            'id_plan'  =>  'required',
            'id_sede'  =>  'required',
        ]);
        DetallePrograma::create($request->all());
        return redirect()->route('DetallePrograma.index');
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
        $det = DetallePrograma::find($id);
        $pro = Programa::all();
        $plan = Plan::all();
        $sede = Sede::all();
        return view('DetallePrograma.edit', compact('pro','plan','sede','det'))->with('det',$det);
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
            'id_programa'  =>  'required',
            'cod_detalle_programa'  =>  'required|max:10',
            'des_detalle_programa'  =>  'required|max:50',
            'id_plan'  =>  'required',
            'id_sede'  =>  'required',
        ]);
        $det = DetallePrograma::find($id);
        $det ->update($request->all());
        return redirect()->route('DetallePrograma.index');
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

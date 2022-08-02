<?php

namespace App\Http\Controllers;

use App\Models\DetallePrograma;
use App\Models\Mencion;
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
        $men = Mencion::all();
        $plan = Plan::all();
        return view('DetallePrograma.create', compact('men','plan'));
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
            'id_mencion'  =>  'required',
            'id_plan'  =>  'required',
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
        $men = Mencion::all();
        $plan = Plan::all();
        return view('DetallePrograma.edit', compact('men','plan','det'))->with('det',$det);
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
            'id_mencion'  =>  'required',
            'id_plan'  =>  'required',
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

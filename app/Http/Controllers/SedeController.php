<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sede;
use App\Http\Controllers\Controller;
use App\Models\Plan;

class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sede = Sede::all();
        $plan = Plan::all();
        return view('modulo_administrador.Sede.index', compact('sede', 'plan'));
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
            'sede'  =>  'required|max:30',
            'id_plan'  =>  'required',
        ]);

        $sede = Sede::create([
            "sede" => $request->sede,
            "id_plan" => $request->id_plan
        ]);
        
        session()->flash('new', '¡Sede Creada Satisfactoriamente!');
        return redirect()->route('Sede.index');
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
        $request->validate([
            'sede'  =>  'required|max:30',
            'id_plan'  =>  'required',
        ]);

        $sede = Sede::find($id);
        $sede->sede = $request->sede;
        $sede->id_plan = $request->id_plan;
        $sede->save();
        if($sede->save()){
            return redirect(to: '/Sede')->with('edit', '¡Sede Actualizada Satisfactoriamente!');
        }else{
            exit();
        }
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

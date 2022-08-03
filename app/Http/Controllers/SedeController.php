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
        $se = Sede::orderBy('cod_sede','ASC')->paginate();
        return view('Sede.index', compact('se'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan = Plan::all();
        return view('Sede.create', compact('plan'));
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
        Sede::create($request->all());
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
        $se = Sede::find($id);
        $plan = Plan::all();
        return view('Sede.edit', compact('plan'))->with('se',$se);
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
        $sede->sede = $request->get('sede');
        $sede->id_plan = $request->get('id_plan');
        $sede->save();
        return redirect()->route('Sede.index')->with('success', 'Sede actualizado correctamente');
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

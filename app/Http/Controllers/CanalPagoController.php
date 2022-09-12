<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CanalPago;

class CanalPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $canalPa = CanalPago::orderBy('canal_pago_id','ASC')->paginate(10);
        return view('CanalPago.index', compact('canalPa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'descripcion'  =>  'required|max:200',
        ]);

        $canalPa = CanalPago::create([
            "descripcion" => $request->descripcion,
        ]);
        
        session()->flash('new', '¡Canal de Pago Creado Satisfactoriamente!');
        return redirect()->route('CanalPago.index');
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
            'descripcion'  =>  'required|max:200',
        ]);
        $canalPa = CanalPago::find($id);
        $canalPa ->update($request->all());
        if($canalPa->save()){
            return redirect(to: '/CanalPago')->with('edit', '¡Canal de Pago Actualizado Satisfactoriamente');
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

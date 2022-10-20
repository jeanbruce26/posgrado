<?php

namespace App\Http\Controllers;

use App\Models\Mencion;
use App\Models\SubPrograma;
use Illuminate\Http\Request;

class MencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mencion = Mencion::orderBy('id_mencion','ASC')->get();
        $sub = SubPrograma::all();
        return view('Mencion.index', compact('mencion', 'sub'));
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
            'cod_mencion'  =>  'max:10',
            'mencion'  =>  'max:200',
            'id_subprograma'  =>  'required|numeric',
        ]);

        $mencion = Mencion::create([
            "cod_mencion" => $request->cod_mencion,
            "mencion" =>$request->mencion,
            "id_subprograma" => $request->id_subprograma
        ]);
        
        session()->flash('new', '¡Mención Creado Satisfactoriamente!');
        return redirect()->route('Mencion.index');
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
            'cod_mencion'  =>  'max:10',
            'mencion'  =>  'max:200',
            'id_subprograma'  =>  'required|numeric',
        ]);

        $mencion = Mencion::find($id);
        $mencion->update($request->all());
        if($mencion->save()){
            return redirect(to: '/Mencion')->with('edit', '¡Mención Actualizado Satisfactoriamente!');
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

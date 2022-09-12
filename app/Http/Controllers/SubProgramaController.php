<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use App\Models\SubPrograma;
use Illuminate\Http\Request;

class SubProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub = SubPrograma::orderBy('id_subprograma','ASC')->paginate(10);
        $pro = Programa::all();
        return view('SubPrograma.index', compact('sub', 'pro'));
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
            'cod_subprograma'  =>  'required|max:10',
            'subprograma'  =>  'required|max:200',
            'id_programa'  =>  'required|numeric',
        ]);

        $sub = SubPrograma::create([
            "cod_subprograma" => $request->cod_subprograma,
            "subprograma" => $request->subprograma,
            "id_programa" => $request->id_programa
        ]);
        
        session()->flash('new', '¡Sub Programa Creado Satisfactoriamente!');
        return redirect()->route('SubPrograma.index');
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
            'cod_subprograma'  =>  'required|max:10',
            'subprograma'  =>  'required|max:200',
            'id_programa'  =>  'required|numeric',
        ]);

        $sub = SubPrograma::find($id);
        $sub->cod_subprograma = $request->cod_subprograma;
        $sub->subprograma = $request->subprograma;
        $sub->id_programa = $request->id_programa;
        $sub->save();
        if($sub->save()){
            return redirect(to: '/SubPrograma')->with('edit', '¡Sub Programa Actualizado Satisfactoriamente!');
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

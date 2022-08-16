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
        $sub = SubPrograma::orderBy('id_subprograma','ASC')->paginate();
        return view('SubPrograma.index', compact('sub'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pro = Programa::all();
        return view('SubPrograma.create', compact('pro'));
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
            'subprograma'  =>  'required|max:50',
            'id_programa'  =>  'required|numeric',
        ]);
        SubPrograma::create($request->all());
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
        $sub = SubPrograma::find($id);
        $pro = Programa::all();
        return view('SubPrograma.edit', compact('pro'))->with('sub',$sub);
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
            'subprograma'  =>  'required|max:50',
            'id_programa'  =>  'required|numeric',
        ]);
        $mencion = SubPrograma::find($id);
        $mencion ->update($request->all());
        return redirect()->route('SubPrograma.index');
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

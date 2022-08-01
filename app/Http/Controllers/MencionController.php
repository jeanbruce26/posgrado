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
        $mencion = Mencion::orderBy('id_mencion','ASC')->paginate();
        return view('Mencion.index', compact('mencion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub = SubPrograma::all();
        return view('Mencion.create', compact('sub'));
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
            'mencion'  =>  'max:50',
            'id_subprograma'  =>  'required|max:50',
        ]);
        Mencion::create($request->all());
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
        $mencion = Mencion::find($id);
        $sub = SubPrograma::all();
        return view('Mencion.edit', compact('sub'))->with('mencion',$mencion);
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
            'mencion'  =>  'max:50',
            'id_subprograma'  =>  'required|max:50',
        ]);
        $mencion = Mencion::find($id);
        $mencion ->update($request->all());
        return redirect()->route('Mencion.index');
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

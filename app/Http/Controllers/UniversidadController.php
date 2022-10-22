<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Universidad;

class UniversidadController extends Controller
{
public function index()
{
    $uni = Universidad::orderBy('cod_uni','ASC')->paginate(10);
    return view('modulo_administrador.Universidad.index', compact('uni'));
}

public function create()
{
    return view('modulo_administrador.Universidad.create');
}

public function store(Request $request)
{
    $request->validate([
        'universidad'  =>  'required|min:10',
        'depart'  =>  'required',
        'tipo_gesti'  =>  'required',
    ]);
    Universidad::create($request->all());
    return redirect()->route('Universidad.index');
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
    $uni = Universidad::find($id);
    return view('modulo_administrador.Universidad.edit')->with('uni',$uni);
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
        'universidad'  =>  'required|min:10',
        'depart'  =>  'required',
        'tipo_gesti'  =>  'required',
    ]);
    $uni = Universidad::find($id);
    $uni ->update($request->all());
    return redirect()->route('Universidad.index');
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

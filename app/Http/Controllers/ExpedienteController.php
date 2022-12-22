<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expediente;

class ExpedienteController extends Controller
{
    
    public function index()
    {
        return view('modulo_administrador.Expediente.index');
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'tipo_doc'  =>  'required|max:200',
    //         'complemento'  =>  'nullable|string|max:200',
    //         'requerido'  =>  'required|numeric',
    //         'estado'  =>  'required|numeric',
    //     ]);

    //     $exp = Expediente::create([
    //         "tipo_doc" => $request->tipo_doc,
    //         "complemento" => $request->complemento,
    //         "requerido" => $request->requerido,
    //         "estado" => $request->estado
    //     ]);
        
    //     session()->flash('new', 'Expediente Creado Satisfactoriamente!');
    //     return redirect()->route('Expediente.index');
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'tipo_doc'  =>  'required|max:45',
    //         'complemento'  =>  'nullable|string|max:200',
    //         'requerido'  =>  'required|numeric',
    //         'estado'  =>  'required|numeric',
    //     ]);

    //     $exp = Expediente::find($id);
    //     $exp ->update($request->all());

    //     if($exp->save()){
    //         return redirect(to: '/Expediente')->with('edit', 'Expediente Actualizado Satisfactoriamente');
    //     }else{
    //         exit();
    //     }
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}

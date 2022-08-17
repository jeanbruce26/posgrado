<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Models\ExpedienteInscripcion;
use App\Models\Persona;
use App\Models\Admision;
use App\Models\DetallePrograma;
use App\Models\Expediente;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insc = Inscripcion::orderBy('id_inscripcion','ASC')->paginate();
        $expediente = Expediente::all();
        $cantidadExp = Expediente::count();
        return view('Inscripcion.index', compact('insc', 'expediente', 'cantidadExp'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $insc = Inscripcion::find($id);

        $request->validate([
            'estado'  =>  'required|max:45',
        ]);
        $insc = Inscripcion::find($id);
        $insc->update($request->all());
        if($insc->save()){
            return redirect(to: '/Inscripcion')->with('edit', 'Estado Actualizado.');
        }else{
            return redirect(to: '/Inscripcion')->with('error', 'Error al Actualizar Estado.');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programa;
use App\Http\Controllers\Controller;
use App\Models\Sede;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pro = Programa::orderBy('id_programa','ASC')->paginate(10);
        $sede = Sede::all();
        return view('Programa.index', compact('pro', 'sede'));
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
            'descripcion_programa'  =>  'required|max:30',
            'id_sede'  =>  'required',
        ]);

        $pro = Programa::create([
            "descripcion_programa" => $request->descripcion_programa,
            "id_sede" => $request->id_sede
        ]);
        
        session()->flash('new', 'Programa Creado Satisfactoriamente!');
        return redirect()->route('Programa.index');
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
        // dd($request);
        $request->validate([
            'descripcion_programa'  =>  'required|max:30',
            'id_sede'  =>  'required|numeric',
        ]);

        $pro = Programa::find($id);
        $pro->descripcion_programa = $request->descripcion_programa;
        $pro->id_sede = $request->id_sede;
        $pro->save();
        if($pro->save()){
            return redirect(to: '/Programa')->with('edit', 'Programa Actualizado Satisfactoriamente');
        }else{
            exit();
        }
        
        
        return redirect()->route('Programa.index');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admision;

class AdmisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // auth()->attempt();
        $admi = Admision::orderBy('cod_admi','DESC')->paginate(10);
        return view('Admision.index', compact('admi'));
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
            'admision'  =>  'required|max:45',
            'estado'  =>  'required|numeric',
        ]);

        $admi = Admision::create([
            "admision" => $request->admision,
            "estado" => $request->estado
        ]);
        
        session()->flash('new', '¡Admisión Creada Satisfactoriamente!');
        return redirect()->route('Admision.index');
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
            'admision'  =>  'required|max:45',
            'estado'  =>  'required|numeric',
        ]);
        $admi = Admision::find($id);
        $admi->update($request->all());
        if($admi->save()){
            return redirect(to: '/Admision')->with('edit', '¡Admisión Actualizada Satisfactoriamente');
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

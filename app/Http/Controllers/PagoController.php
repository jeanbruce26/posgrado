<?php

namespace App\Http\Controllers;


use App\Models\Pago;
use App\Models\CanalPago;
use Illuminate\Http\Request;

class PagoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pago = Pago::orderBy('pago_id','DESC')->paginate(10);
        $canalPago = CanalPago::all();
        return view('Pago.index', compact('pago', 'canalPago'));
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
        $encontrado = false;

        $pago = Pago::all();
        foreach ($pago as $item) {
            if($item->fecha_pago == $request->fecha_pago && $item->nro_operacion == $request->nro_operacion){
                $encontrado = true;
            }
            // dump($encontrado, $item->fecha_pago, $request->fecha_pago, $item->nro_operacion, $request->nro_operacion);
        }

        if($encontrado == true){
            session()->flash('dupli', '¡El Pago ingresado ya fue registrado!');
            return redirect()->route('Pago.index');
        }else{
            $request->validate([
                'dni'  =>  'required|min:8',
                'nro_operacion'  =>  'required|numeric',
                'monto'  =>  'required|numeric',
                'fecha_pago'  =>  'required|date',
                'canal_pago_id'  =>  'required|numeric'
            ]);
            
    
            $pago = Pago::create([
                "dni" => $request->dni,
                "nro_operacion" =>$request->nro_operacion,
                "monto" => $request->monto,
                "fecha_pago" => $request->fecha_pago,
                "estado" => 1,
                "canal_pago_id" => $request->canal_pago_id
            ]);
            
            session()->flash('new', '¡Pago Creado Satisfactoriamente!');
            return redirect()->route('Pago.index');
        }

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
            'dni'  =>  'required|min:8',
            'nro_operacion'  =>  'required|numeric',
            'monto'  =>  'required|numeric',
            'fecha_pago'  =>  'required|date',
            'canal_pago_id'  =>  'required|numeric',
        ]);
        $pago = Pago::find($id);
        $pago->update($request->all());
        if($pago->save()){
            return redirect(to: '/Pago')->with('edit', '¡Pago Actualizado Satisfactoriamente!');
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

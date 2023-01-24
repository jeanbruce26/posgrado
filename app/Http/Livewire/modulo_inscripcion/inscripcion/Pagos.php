<?php

namespace App\Http\Livewire\modulo_inscripcion\inscripcion;

use App\Models\Admision;
use App\Models\ConceptoPago;
use App\Models\Inscripcion;
use App\Models\InscripcionPago;
use App\Models\Pago;
use App\Models\TipoDocumento;
use Livewire\Component;

class Pagos extends Component
{
    public $concepto_pago2;
    public $tipo_documento2;
    public $documento;
    public $pago=null;
    public $seleccionar=[];
    public $total;
    public $monto = 0;
    
    protected $listeners = ['render', 'guardarPago'];

    public function updated($propertyName)
    {
        if($this->tipo_documento2 == 1){
            $this->validateOnly($propertyName, [
                'tipo_documento2' => 'required|numeric',
                'documento' => 'required|numeric|digits:8',
                'concepto_pago2' => 'required|numeric',
            ]);
        }else{
            $this->validateOnly($propertyName, [
                'tipo_documento2' => 'required|numeric',
                'documento' => 'required|numeric|digits:9',
                'concepto_pago2' => 'required|numeric',
            ]);
        }
    }

    public function buscarPago()
    {
        if($this->tipo_documento2 == 1){
            $data = $this->validate([
                'tipo_documento2' => 'required|numeric',
                'documento' => 'required|numeric|digits:8',
                'concepto_pago2' => 'required|numeric',
            ]);
        }else{
            $data = $this->validate([
                'tipo_documento2' => 'required|numeric',
                'documento' => 'required|numeric|digits:9',
                'concepto_pago2' => 'required|numeric',
            ]);
        }

        if($this->documento != auth('pagos')->user()->dni){
            return redirect()->back()->with(array('mensaje-dni'=>'El documento de identidad ingresado no puede ser buscado o no lo pertenece.'));
        }else{
            if(strlen($this->documento) == 8 && $this->tipo_documento2 == 2){
                return redirect()->back()->with(array('mensaje-dni'=>'El documento de identidad ingresado no pertenece al tipo de documento.'));
            }else if(strlen($this->documento) == 9 && $this->tipo_documento2 == 1){
                return redirect()->back()->with(array('mensaje-dni'=>'El documento de identidad ingresado no pertenece al tipo de documento.'));
            }
        }

        $this->pago = Pago::where('dni',$this->documento)->where('estado',1)->get();

        return $this->pago;
    }

    public function contarMonto($id_pago)
    {
        $pago= Pago::select('monto')->where('pago_id',$id_pago)->first();
        $check = $this->seleccionar;
        foreach ($check as $checks){
            $v = $checks;
        }

        if($this->seleccionar && $v == $id_pago){
            $this->monto += $pago->monto;
            $this->total = $this->monto;
        }else{
            $this->monto -= $pago->monto;
            $this->total = $this->monto;
        }
        if(!$this->seleccionar){
            $this->total = 0;
            $this->monto = 0;
        }
    }

    public function guardarPagoAlerta()
    {
        if(!$this->seleccionar){
            return back()->with(array('mensaje-seleccionar'=>'Debe seleccionar su pago para continuar con su inscripcion.'));
        }

        $concepto = ConceptoPago::find($this->concepto_pago2);

        if($concepto->concepto_1 != 1){
            $this->dispatchBrowserEvent('alerta-error-pago', ['mensaje' => 'El concepto de pago ingresado no es el correcto.']);
            return back();
        }

        if(floatval($concepto->monto) > $this->total){
            return back()->with(array('mensaje-seleccionar'=>'El monto ingresado no cumple con el monto minimo del concepto de pago'));
        }

        $this->dispatchBrowserEvent('confirmacion-pago');
    }

    public function guardarPago()
    {
        if(!$this->seleccionar){
            return back()->with(array('mensaje-seleccionar'=>'Debe seleccionar su pago para continuar con su inscripcion.'));
        }

        $concepto = ConceptoPago::find($this->concepto_pago2);
        
        if(floatval($concepto->monto) > $this->total){
            return back()->with(array('mensaje-seleccionar'=>'El monto ingresado no cumple con el monto minimo del concepto de pago'));
        }

        $admision = Admision::where('estado',1)->first()->cod_admi;

        //OBTENER EL ULTIMO CODIGO DE INSCRIPCION y autoincrementar
        $ultimo_codifo_inscripcion = Inscripcion::orderBy('inscripcion_codigo','DESC')->first();
        if($ultimo_codifo_inscripcion == null){
            $codigo_inscripcion = 'IN0001';
        }else{
            $codigo_inscripcion = $ultimo_codifo_inscripcion->inscripcion_codigo;
            $codigo_inscripcion = substr($codigo_inscripcion, 2, 6);
            $codigo_inscripcion = intval($codigo_inscripcion) + 1;
            $codigo_inscripcion = str_pad($codigo_inscripcion, 4, "0", STR_PAD_LEFT);
            $codigo_inscripcion = 'IN'.$codigo_inscripcion;
        }
        
        $inscripcion = Inscripcion::create([
            "inscripcion_codigo" => $codigo_inscripcion,
            "estado" => 'Activo',
            "admision_cod_admi" => $admision,
        ]);
        
        foreach($this->seleccionar as $item){

            $inscripcion_pago = InscripcionPago::create([
                "pago_id" => $item,
                "inscripcion_id" => $inscripcion->id_inscripcion,
                "concepto_pago_id" => $this->concepto_pago2,
            ]);

            $pago = Pago::find($item);
            $pago->estado = 2;
            $pago->save();
        }

        return redirect()->route('inscripcion.inscripcion', $inscripcion->id_inscripcion);
    }

    public function render()
    {
        $concepto_pago = ConceptoPago::where('estado',1)->get();
        $tipo_documento = TipoDocumento::all();
        
        return view('livewire.modulo_inscripcion.inscripcion.pagos', [
            'concepto_pago' => $concepto_pago,
            'tipo_documento' => $tipo_documento,
            'pago' => $this->pago,
            'total' => $this->total
        ]);
    }
}

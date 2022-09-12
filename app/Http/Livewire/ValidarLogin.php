<?php

namespace App\Http\Livewire;

use App\Models\InscripcionPago;
use App\Models\Pago;
use App\Models\TipoDocumento;
use Livewire\Component;

class ValidarLogin extends Component
{
    public $tipo_documento;
    public $documento;
    public $numero_operacion;

    public function updated($propertyName)
    {
        if($this->tipo_documento == 1){
            $this->validateOnly($propertyName, [
                'tipo_documento' => 'required|numeric',
                'documento' => 'required|numeric|digits:8',
                'numero_operacion' => 'required|numeric',
            ]);
        }else{
            $this->validateOnly($propertyName, [
                'tipo_documento' => 'required|numeric',
                'documento' => 'required|numeric|digits:9',
                'numero_operacion' => 'required|numeric',
            ]);
        }
    }

    public function login()
    {
        if($this->tipo_documento == 1){
            $data = $this->validate([
                'tipo_documento' => 'required|numeric',
                'documento' => 'required|numeric|digits:8',
                'numero_operacion' => 'required|numeric',
            ]);
        }else{
            $data = $this->validate([
                'tipo_documento' => 'required|numeric',
                'documento' => 'required|numeric|digits:9',
                'numero_operacion' => 'required|numeric',
            ]);
        }

        $pago = Pago::where('dni',$this->documento)->where('nro_operacion',$this->numero_operacion)->first();

        if(!$pago){
            return redirect()->back()->with(array('mensaje'=>'Credenciales incorrectas'));
        }

        if($pago->estado == 1){
            auth('pagos')->login($pago);
            return redirect()->route('inscripcion');
        }else if($pago->estado == 2){
            $inscripcion = InscripcionPago::join('pago','inscripcion_pago.pago_id','=','pago.pago_id')->where('pago.dni',$this->documento )->where('pago.nro_operacion',$this->numero_operacion)->where('pago.estado',2)->first();
            auth('pagos')->login($pago);
            return redirect()->route('inscripcion.inscripcion', [$inscripcion->inscripcion_id]);
        }else if($pago->estado == 3){
            return back()->with('mensaje','Usted ya no puede realizar una inscripción');
        }
    }

    public function render()
    {
        return view('livewire.validar-login', [
            'tipo_doc' => TipoDocumento::all(),
        ]);
    }
}

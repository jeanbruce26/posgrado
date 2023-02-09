<?php

namespace App\Http\Livewire\ModuloInscripcion\Usuario;

use App\Models\Admitidos;
use App\Models\ConceptoPago;
use App\Models\ConstanciaIngresoPago;
use App\Models\Evaluacion;
use App\Models\MatriculaPago;
use App\Models\Pago;
use App\Models\TipoDocumento;
use Livewire\Component;

class Pagos extends Component
{
    public $concepto_pago;
    public $tipo_documento;
    public $documento;

    public $pago_model = null;

    public $total = 0;
    public $seleccionar=[];

    protected $listeners = ['render', 'guardarPago'];

    public function updated($propertyName)
    {
        if($this->tipo_documento){
            if($this->tipo_documento == 1){
                $this->validateOnly($propertyName, [
                    'concepto_pago' => 'required|numeric',
                    'tipo_documento' => 'required|numeric',
                    'documento' => 'required|numeric|digits:8'
                ]);
            }else{
                $this->validateOnly($propertyName, [
                    'concepto_pago' => 'required|numeric',
                    'tipo_documento' => 'required|numeric',
                    'documento' => 'required|numeric|digits:9'
                ]);
            }
        }else{
            $this->validateOnly($propertyName, [
                'concepto_pago' => 'required|numeric',
                'tipo_documento' => 'required|numeric',
                'documento' => 'required|numeric|digits:8'
            ]);
        }
        
    }

    public function buscarPago()
    {
        if($this->tipo_documento){
            if($this->tipo_documento == 1){
                $this->validate([
                    'concepto_pago' => 'required|numeric',
                    'tipo_documento' => 'required|numeric',
                    'documento' => 'required|numeric|digits:8'
                ]);
            }else{
                $this->validate([
                    'concepto_pago' => 'required|numeric',
                    'tipo_documento' => 'required|numeric',
                    'documento' => 'required|numeric|digits:9'
                ]);
            }
        }else{
            $this->validate([
                'concepto_pago' => 'required|numeric',
                'tipo_documento' => 'required|numeric',
                'documento' => 'required|numeric|digits:8'
            ]);
        }

        if(auth('usuarios')->user()->persona->num_doc != $this->documento){
            return session()->flash('mensaje-buscar', 'El número de documento de identidad ingresado no coincide con el de su cuenta.');
        }

        $this->pago_model = Pago::where('dni', $this->documento)->where('estado', 1)->get();
    }

    public function contarMonto($id_pago)
    {
        $pago= Pago::select('monto')->where('pago_id',$id_pago)->first();
        $concepto = ConceptoPago::find($this->concepto_pago);
        $check = $this->seleccionar;
        
        if(in_array($id_pago, $check)){
            $this->total = $this->total + $pago->monto;
            if($this->total > floatval($concepto->monto)){
                $this->dispatchBrowserEvent('alerta-error-pago', ['mensaje' => 'Monto total excedido', 'tipo' => 'warning']);
                return back();
            }
        }else{
            $this->total = $this->total - $pago->monto;
        }
    }

    public function guardarPagoAlerta()
    {
        if(!$this->seleccionar){
            $this->dispatchBrowserEvent('alerta-error-pago', ['mensaje' => 'Debe seleccionar su pago para continuar.', 'tipo' => 'error']);
            return back();
        }

        $concepto = ConceptoPago::find($this->concepto_pago);

        if($this->concepto_pago == 1){
            $this->dispatchBrowserEvent('alerta-error-pago', ['mensaje' => 'El concepto de pago ingresado no es el correcto.', 'tipo' => 'warning']);
            return back();
        }

        if(floatval($concepto->monto) > $this->total){
            $this->dispatchBrowserEvent('alerta-error-pago', ['mensaje' => 'El monto ingresado no cumple con el monto del concepto de pago.', 'tipo' => 'error']);
            return back();
        }

        $this->dispatchBrowserEvent('confirmacion-pago-usuario');
    }

    public function guardarPago()
    {
        if($this->concepto_pago == 1){
            $this->dispatchBrowserEvent('alerta-error-pago', ['mensaje' => 'El concepto de pago ingresado no es el correcto.', 'tipo' => 'warning']);
            return back();
        }

        sleep(1);

        $evaluacion_id = Evaluacion::where('inscripcion_id',auth('usuarios')->user()->id_inscripcion)->first()->evaluacion_id;
        $admitido = Admitidos::where('evaluacion_id', $evaluacion_id)->first();

        if($this->concepto_pago == 2){ //pago por constancia de ingreso
            foreach($this->seleccionar as $pago_id){
                $pago_constancia = new ConstanciaIngresoPago(); //guardar pago por constancia de ingreso
                $pago_constancia->pago_id = $pago_id;
                $pago_constancia->admitidos_id = $admitido->admitidos_id;
                $pago_constancia->concepto_id = $this->concepto_pago;
                $pago_constancia->save();

                $pago = Pago::find($pago_id); //actualizar estado del pago
                $pago->estado = 3;
                $pago->save();
            }
        }else if($this->concepto_pago == 3){ //pago por matricula
            foreach($this->seleccionar as $pago_id){
                $pago_matricula = new MatriculaPago(); //guardar pago por matricula
                $pago_matricula->pago_id = $pago_id;
                $pago_matricula->admitidos_id = $admitido->admitidos_id;
                $pago_matricula->concepto_id = $this->concepto_pago;
                $pago_matricula->save();

                $pago = Pago::find($pago_id); //actualizar estado del pago
                $pago->estado = 3;
                $pago->save();
            }
        }else if($this->concepto_pago == 4){
            foreach($this->seleccionar as $pago_id){
                $pago_constancia = new ConstanciaIngresoPago(); //guardar pago por constancia de ingreso
                $pago_constancia->pago_id = $pago_id;
                $pago_constancia->admitidos_id = $admitido->admitidos_id;
                $pago_constancia->concepto_id = $this->concepto_pago;
                $pago_constancia->save();

                $pago_matricula = new MatriculaPago(); //guardar pago por matricula
                $pago_matricula->pago_id = $pago_id;
                $pago_matricula->admitidos_id = $admitido->admitidos_id;
                $pago_matricula->concepto_id = $this->concepto_pago;
                $pago_matricula->save();

                $pago = Pago::find($pago_id); //actualizar estado del pago
                $pago->estado = 3;
                $pago->save();
            }
        }

        return redirect()->route('usuarios.index');
    }

    public function render()
    {
        $concepto_pago_model = ConceptoPago::where('estado', 1)->get();
        $tipo_documento_model = TipoDocumento::all();
        $num = 1;

        return view('livewire.modulo-inscripcion.usuario.pagos',[
            'concepto_pago_model' => $concepto_pago_model,
            'tipo_documento_model' => $tipo_documento_model,
            'num' => $num
        ]);
    }
}

<?php

namespace App\Http\Livewire\ModuloCoordinador;

use Livewire\Component;
use App\Models\Inscripcion;
use App\Models\Evaluacion;
use App\Models\EvaluacionExpediente;
use App\Models\EvaluacionExpedienteTitulo;

class Expediente extends Component
{
    public $inscripcion_id;
    public $evaluacion_id;
    public $nota;
    public $total = 0;
    public $id_eva_exp;
    // estado 1 => por evaluar
    // estado 2 => evaluacion observada
    // estado 3 => evaluado
    
    protected $listeners = ['render', 'evaluarExpediente'];

    public function updated($propertyName)
    {
        if($this->id_eva_exp == 1){
            $this->validateOnly($propertyName, [
                'nota' => 'required|numeric|min:0|max:4'
            ]);
        }else if($this->id_eva_exp == 2){
            $this->validateOnly($propertyName, [
                'nota' => 'required|numeric|min:0|max:5',
            ]);
        }else if($this->id_eva_exp == 3){
            $this->validateOnly($propertyName, [
                'nota' => 'required|numeric|min:0|max:2',
            ]);
        }else if($this->id_eva_exp == 4){
            $this->validateOnly($propertyName, [
                'nota' => 'required|numeric|min:0|max:4'
            ]);
        }else if($this->id_eva_exp == 5){
            $this->validateOnly($propertyName, [
                'nota' => 'required|numeric|min:0|max:8'
            ]);
        }else if($this->id_eva_exp == 6){
            $this->validateOnly($propertyName, [
                'nota' => 'required|numeric|min:0|max:4'
            ]);
        }else if($this->id_eva_exp == 7){
            $this->validateOnly($propertyName, [
                'nota' => 'required|numeric|min:0|max:3'
            ]);
        }
        
        $this->contarTotal();
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->reset('nota');
    }

    public function contarTotal()
    {
        $eva = EvaluacionExpediente::where('evaluacion_id',$this->evaluacion_id)->get();
        $this->total = 0;
        foreach($eva as $item){
            $this->total = $this->total + $item->evaluacion_expediente_nota;
        }
    }

    public function cargarId($id_exp)
    {
        $this->id_eva_exp = $id_exp;

        $eva = EvaluacionExpediente::where('evaluacion_expediente_titulo_id',$this->id_eva_exp)->where('evaluacion_id',$this->evaluacion_id)->first();
        
        if($eva){
            $this->nota = number_format($eva->evaluacion_expediente_nota, 0);
        }
    }

    public function agregarNota()
    {
        if($this->id_eva_exp == 1){
            $this->validate([
                'nota' => 'required|numeric|min:3|max:4'
            ]);
        }else if($this->id_eva_exp == 2){
            $this->validate([
                'nota' => 'required|numeric|min:0|max:5',
            ]);
        }else if($this->id_eva_exp == 3){
            $this->validate([
                'nota' => 'required|numeric|min:0|max:2',
            ]);
        }else if($this->id_eva_exp == 4){
            $this->validate([
                'nota' => 'required|numeric|min:0|max:4'
            ]);
        }else if($this->id_eva_exp == 5){
            $this->validate([
                'nota' => 'required|numeric|min:0|max:8'
            ]);
        }else if($this->id_eva_exp == 6){
            $this->validate([
                'nota' => 'required|numeric|min:0|max:4'
            ]);
        }else if($this->id_eva_exp == 7){
            $this->validate([
                'nota' => 'required|numeric|min:0|max:3'
            ]);
        }

        // dd($this->all());

        $eva = EvaluacionExpediente::where('evaluacion_expediente_titulo_id',$this->id_eva_exp)->where('evaluacion_id',$this->evaluacion_id)->first();
        
        if($eva){
            $eva->evaluacion_expediente_nota = $this->nota;
            $eva->save();
            session()->flash('message', 'Nota actualizada satisfactoriamente.');
        }else{
            $eva_expe = EvaluacionExpediente::create([
                "evaluacion_expediente_nota" => $this->nota,
                "evaluacion_expediente_titulo_id" => $this->id_eva_exp,
                "evaluacion_id" => $this->evaluacion_id,
            ]);
            session()->flash('message', 'Nota agregada satisfactoriamente.');
        }

        $this->limpiar();

        $this->contarTotal();

        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function evaluar()
    {
        $eva = EvaluacionExpediente::where('evaluacion_id',$this->evaluacion_id)->count();

        if($eva == 7){
            // $evaluacion = Evaluacion::find($this->evaluacion_id);
            // $inscripcion = Inscripcion::find($evaluacion->inscripcion_id);
            // $evaluacion->nota_expediente = $this->total;
            // if($this->total <= $evaluacion->Puntaje->puntaje_minimo_expediente){
            //     $evaluacion->evaluacion_observacion = 'Puntaje minimo no alcanzado en la Evaluacion de Expedientes.';
            //     $evaluacion->evaluacion_estado = 2;
            // }
            // $evaluacion->save();
            // return redirect()->route('coordinador.inscripciones',$inscripcion->id_mencion);
            $this->dispatchBrowserEvent('alertaConfirmacionExpediente');
        }else{
            session()->flash('danger', 'Faltan notas por ingresar.');
        }
    }

    public function evaluarExpediente()
    {
        $evaluacion = Evaluacion::find($this->evaluacion_id);
        $inscripcion = Inscripcion::find($evaluacion->inscripcion_id);
        $evaluacion->nota_expediente = $this->total;
        if($this->total <= $evaluacion->Puntaje->puntaje_minimo_expediente){
            $evaluacion->evaluacion_observacion = 'Puntaje minimo no alcanzado en la Evaluacion de Expedientes.';
            $evaluacion->evaluacion_estado = 2;
        }
        $evaluacion->save();
        return redirect()->route('coordinador.inscripciones',$inscripcion->id_mencion);
    }

    public function render()
    {
        date_default_timezone_set("America/Lima");
        $this->contarTotal();
        $evaluacion_data = Evaluacion::find($this->evaluacion_id);
        $boton = $evaluacion_data->nota_expediente;
        $inscripcion = Inscripcion::find($evaluacion_data->inscripcion_id);
        $fecha = today();

        $evaluacion_expediente = EvaluacionExpedienteTitulo::all();

        return view('livewire.modulo-coordinador.expediente', [
            'inscripcion' => $inscripcion,
            'evaluacion_data' => $evaluacion_data,
            'fecha' => $fecha,
            'boton' => $boton,
            'evaluacion_expediente' => $evaluacion_expediente,
        ]);
    }
}

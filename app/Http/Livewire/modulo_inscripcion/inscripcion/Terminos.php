<?php

namespace App\Http\Livewire\modulo_inscripcion\inscripcion;

use App\Models\Expediente;
use Livewire\Component;

class Terminos extends Component
{
    public $check;

    protected $rules = [
        'check' => 'accepted'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function aceptarTerminos()
    {
        if($this->check == false){
            $this->check = true;
        }else{
            $this->check = false;
        }
    }

    public function terminos()
    {
        $data = $this->validate();

        return redirect()->route('inscripcion.pagos');
    }

    public function render()
    {
        return view('livewire.modulo_inscripcion.inscripcion.terminos',[
            'expediente' => Expediente::where('estado',1)->get(),
        ]);
    }
}

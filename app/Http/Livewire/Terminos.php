<?php

namespace App\Http\Livewire;

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

    public function terminos()
    {
        $data = $this->validate();

        return redirect()->route('inscripcion.pagos');
    }

    public function render()
    {
        return view('livewire.terminos',[
            'expediente' => Expediente::where('estado',1)->get(),
        ]);
    }
}

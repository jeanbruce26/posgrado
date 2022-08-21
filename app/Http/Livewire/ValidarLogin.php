<?php

namespace App\Http\Livewire;

use App\Models\TipoDocumento;
use Livewire\Component;

class ValidarLogin extends Component
{
    public $tipo_documento;
    public $documento;
    public $nro_operacion;

    protected $rules = [
        'tipo_documento'  =>  'required|numeric',
        'documento'  =>  'required|numeric|integer|digits:8',
        'nro_operacion'  =>  'required|numeric|integer|digits:6'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.validar-login', [
            'tipo_doc' => TipoDocumento::all(),
        ]);
    }
}

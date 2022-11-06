<?php

namespace App\Http\Livewire\ModuloAdministrador\InscripcionPago;

use App\Models\InscripcionPago;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';
    public function render()
    {
        $inscripcion_pagos = InscripcionPago::join('inscripcion','inscripcion_pago.inscripcion_id','=','inscripcion.id_inscripcion')
                ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->join('pago','inscripcion_pago.pago_id','=','pago.pago_id')
                ->where('persona.nombres','LIKE',"%{$this->search}%")
                ->orWhere('persona.apell_pater','LIKE',"%{$this->search}%")
                ->orWhere('persona.apell_mater','LIKE',"%{$this->search}%")
                ->orWhere('inscripcion_pago.inscripcion_pago_id','LIKE',"%{$this->search}%")
                ->orWhere('pago.dni','LIKE',"%{$this->search}%")
                ->orderBy('inscripcion_pago_id','DESC')
                ->paginate(100);

        return view('livewire.modulo-administrador.inscripcion-pago.index', [
            'inscripcion_pagos' => $inscripcion_pagos
        ]);
    }
}

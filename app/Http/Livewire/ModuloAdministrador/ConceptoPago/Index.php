<?php

namespace App\Http\Livewire\ModuloAdministrador\ConceptoPago;

use App\Models\ConceptoPago;
use Livewire\Component;

class Index extends Component
{

    public $search = '';
    public $titulo = 'Crear Concepto de Pago';
    public $modo = 1; 
    //1=new / 2=update

    public $conceptoPago_id;

    public function render()
    {
        $buscar = $this->search;
        $conceptoPago = ConceptoPago::where('canal_pago_id','LIKE',"%{$buscar}%")
                        ->orWhere('descripcion','LIKE',"%{$buscar}%")
                        ->orderBy('canal_pago_id','DESC')->get();
        return view('livewire.modulo-administrador.concepto-pago.index');
    }
}

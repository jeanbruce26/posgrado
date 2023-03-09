<?php

namespace App\Http\Livewire\ModuloContable;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pago as PagoModel;

class Pago extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {
        $buscar = $this->search;
        $pago = PagoModel::where('fecha_pago','LIKE',"%{$buscar}%")
                ->orWhere('dni','LIKE',"%{$buscar}%")
                ->orWhere('nro_operacion','LIKE',"%{$buscar}%")
                ->orWhere('pago_id','LIKE',"%{$buscar}%")
                ->orderBy('pago_id','DESC')->paginate(200);

        return view('livewire.modulo-contable.pago', [
            'pago' => $pago
        ]);
    }
}

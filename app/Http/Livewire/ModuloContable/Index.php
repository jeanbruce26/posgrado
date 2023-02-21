<?php

namespace App\Http\Livewire\ModuloContable;

use App\Models\Pago;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $ingreso_total = Pago::sum('monto');
        $ingreso_inscripcion = Pago::where('estado', 3)->sum('monto');
        $ingreso_constancia = Pago::where('estado', 4)->sum('monto');
        // dd($ingreso_total);

        return view('livewire.modulo-contable.index', [
            'ingreso_total' => $ingreso_total,
            'ingreso_inscripcion' => $ingreso_inscripcion,
            'ingreso_constancia' => $ingreso_constancia,
        ]);
    }
}

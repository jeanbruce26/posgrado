<?php

namespace App\Http\Livewire\ModuloCoordinador\ModuloInscripcion;

use App\Exports\CoordinadorDataInscripcionesExport;
use App\Models\InscripcionPago;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Inscripcion extends Component
{
    public $id_mencion;
    public $search = '';

    public function export_excel() 
    {
        $fecha_actual = date("Ymd", strtotime(today()));
        $hora_actual = date("His", strtotime(now()));

        $this->dispatchBrowserEvent('notificacionExcel', ['message' =>'Excel exportado satisfactoriamente.', 'color' => '#2eb867']);

        return Excel::download(new CoordinadorDataInscripcionesExport($this->id_mencion), 'data-inscripciones-'.$fecha_actual.'-'.$hora_actual.'.xlsx');
    }
    
    public function render()
    {
        $id_mencion = $this->id_mencion;
        $search = $this->search;

        $inscripciones_pagos = InscripcionPago::join('inscripcion','inscripcion_pago.inscripcion_id','=','inscripcion.id_inscripcion')
                ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->join('pago','inscripcion_pago.pago_id','=','pago.pago_id')
                ->where('inscripcion.id_mencion', $id_mencion)
                ->where(function($query) use ($search){
                    $query->where('persona.nombres','LIKE',"%{$search}%")
                    ->orWhere('persona.apell_pater','LIKE',"%{$search}%")
                    ->orWhere('persona.apell_mater','LIKE',"%{$search}%")
                    ->orWhere('persona.nombre_completo','LIKE',"%{$search}%")
                    ->orWhere('inscripcion.id_inscripcion','LIKE',"%{$search}%")
                    ->orWhere('subprograma.subprograma','LIKE',"%{$search}%")
                    ->orWhere('mencion.mencion','LIKE',"%{$search}%")
                    ->orWhere('programa.descripcion_programa','LIKE',"%{$search}%")
                    ->orWhere('persona.num_doc','LIKE',"%{$search}%");
                })
                ->orderBy('persona.nombre_completo', 'asc')
                ->get();

        return view('livewire.modulo-coordinador.modulo-inscripcion.inscripcion', [
            'inscripciones_pagos' => $inscripciones_pagos,
        ]);
    }
}

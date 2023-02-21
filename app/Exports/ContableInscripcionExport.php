<?php

namespace App\Exports;

use App\Models\InscripcionPago;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContableInscripcionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $array = [];
        $inscripcion_pago = InscripcionPago::select('inscripcion.id_inscripcion','persona.nombre_completo','persona.num_doc','pago.nro_operacion','pago.monto','pago.fecha_pago', InscripcionPago::raw('IF(mencion.mencion IS NULL, CONCAT(CONCAT(programa.descripcion_programa," EN "), subprograma.subprograma), CONCAT(CONCAT(CONCAT(CONCAT(programa.descripcion_programa," EN "), subprograma.subprograma)," CON MENCION EN "), mencion.mencion))'))
                                            ->join('inscripcion','inscripcion_pago.inscripcion_id','=','inscripcion.id_inscripcion')
                                            ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                                            ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                                            ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                                            ->join('programa','subprograma.id_programa','=','programa.id_programa')
                                            ->join('pago','inscripcion_pago.pago_id','=','pago.pago_id')
                                            ->get();
                                            
        return $inscripcion_pago;
    }
    
    public function headings(): array
    {
        return ["ID", "Apellidos y Nombres", "Documento", "Nro de Operacion", "Monto", "Fecha de Pago", "Programa"];
    }
}

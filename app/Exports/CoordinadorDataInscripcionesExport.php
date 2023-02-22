<?php

namespace App\Exports;

use App\Models\InscripcionPago;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CoordinadorDataInscripcionesExport implements FromCollection, WithHeadings
{
    public $id_mencion;

    public function __construct($id_mencion)
    {
        $this->id_mencion = $id_mencion;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $id_mencion = $this->id_mencion;
        $inscripcion_pago = InscripcionPago::select('inscripcion.id_inscripcion','persona.nombre_completo','persona.num_doc','persona.celular1',InscripcionPago::raw('IF(persona.celular2 IS NULL, " ", persona.celular2)'),'persona.email',InscripcionPago::raw('IF(persona.email2 IS NULL, " ", persona.email2)'),'pago.nro_operacion','pago.monto','pago.fecha_pago')
                                            ->join('inscripcion','inscripcion_pago.inscripcion_id','=','inscripcion.id_inscripcion')
                                            ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                                            ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                                            ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                                            ->join('programa','subprograma.id_programa','=','programa.id_programa')
                                            ->join('pago','inscripcion_pago.pago_id','=','pago.pago_id')
                                            ->where('inscripcion.id_mencion', $id_mencion)
                                            ->get();
        
        return $inscripcion_pago;
    }

    public function headings(): array
    {
        return ["ID", "Apellidos y Nombres", "Documento", "Celular", "Celular Opcional", "Correo Electronico", "Correo Electronico Opcional", "Nro de Operacion", "Monto", "Fecha de Pago"];
    }
}

<?php

namespace App\Exports;

use App\Models\Admitidos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $admitidos = Admitidos::select('admitidos.admitidos_id','admitidos.admitidos_codigo',Admitidos::raw('CONCAT(CONCAT(CONCAT(CONCAT(persona.apell_pater," "), persona.apell_mater),", "), persona.nombres) as nombre_completo'),'persona.num_doc','admitidos.constancia_codigo')
                ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->get();
        return $admitidos;
    }

    public function headings(): array
    {
        return ["ID", "Codigo", "Apellidos y Nombres", "DNI", "Codigo de Constancia"];
    }
}

<?php

namespace App\Exports\ModuloAdministrador\Admitidos;

use App\Models\GrupoPrograma;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportAdmitidosMatriculadosMultipleSheets implements WithMultipleSheets
{
    use Exportable;
    public $id_mencion;

    public function __construct($id_mencion)
    {
        $this->id_mencion = $id_mencion;
    }

    public function sheets(): array
    {
        $grupo_programa = GrupoPrograma::where('id_mencion', $this->id_mencion)->get();
        $sheets = [];

        foreach ($grupo_programa as $grupo) {
            $sheets[] = new ExportAdmitidosMatriculados($grupo->id_grupo_programa, $grupo->grupo);
        }

        $sheets[] = new ExportAdmitidosNoMatriculados($this->id_mencion);

        return $sheets;
    }
}

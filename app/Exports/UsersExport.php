<?php

namespace App\Exports;

use App\Models\Admitidos;
use App\Models\MatriculaPago;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Sheet;

class UsersExport implements FromCollection, WithHeadings, WithEvents
{
    public function collection()
    {
        $matriculados = collect();

        $admitidos = Admitidos::select('admitidos.admitidos_id','admitidos.admitidos_codigo', 'persona.apell_pater', 'persona.apell_mater', 'persona.nombres','persona.num_doc', 'persona.direccion', 'sexo', 'fecha_naci', 'est_civil.est_civil', 'persona.email', 'persona.celular1', 'univer.universidad', 'persona.año_egreso', 'grado_academico.nom_grado', 'persona.especialidad','admitidos.constancia_codigo', Admitidos::raw('IF(mencion.mencion IS NULL, CONCAT(CONCAT(programa.descripcion_programa," EN "), subprograma.subprograma), CONCAT(CONCAT(CONCAT(CONCAT(programa.descripcion_programa," EN "), subprograma.subprograma)," CON MENCION EN "), mencion.mencion)) as descripcion_programa'))
                ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->join('grado_academico','persona.id_grado_academico','=','grado_academico.id_grado_academico')
                ->join('est_civil','persona.est_civil_cod_est','=','est_civil.cod_est')
                ->join('univer', 'persona.univer_cod_uni','=','univer.cod_uni')
                ->join('mencion','admitidos.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->orderBy('admitidos.id_mencion', 'asc')
                ->get();

        foreach ($admitidos as $item) {
            $matricula_pago = MatriculaPago::where('admitidos_id', $item->admitidos_id)->first();
            
            if ($matricula_pago) {
                $matriculados->push([
                    'admitidos_id' => $item->admitidos_id,
                    'admitidos_codigo' => $item->admitidos_codigo,
                    'nombre_completo' => $item->nombre_completo,
                    'num_doc' => $item->num_doc,
                    'direccion' => $item->direccion,
                    'sexo' => $item->sexo,
                    'fecha_naci' => $item->fecha_naci,
                    'est_civil' => $item->est_civil,
                    'email' => $item->email,
                    'celular1' => $item->celular1,
                    'universidad' => $item->universidad,
                    'año_egreso' => $item->año_egreso,
                    'nom_grado' => $item->nom_grado,
                    'especialidad' => $item->especialidad,
                    'constancia_codigo' => $item->constancia_codigo,
                    'descripcion_programa' => $item->descripcion_programa,
                    'matricula_pago' => 'SI'
                ]);
            } else {
                $matriculados->push([
                    'admitidos_id' => $item->admitidos_id,
                    'admitidos_codigo' => $item->admitidos_codigo,
                    'nombre_completo' => $item->nombre_completo,
                    'num_doc' => $item->num_doc,
                    'direccion' => $item->direccion,
                    'sexo' => $item->sexo,
                    'fecha_naci' => $item->fecha_naci,
                    'est_civil' => $item->est_civil,
                    'email' => $item->email,
                    'celular1' => $item->celular1,
                    'universidad' => $item->universidad,
                    'año_egreso' => $item->año_egreso,
                    'nom_grado' => $item->nom_grado,
                    'especialidad' => $item->especialidad,
                    'constancia_codigo' => $item->constancia_codigo,
                    'descripcion_programa' => $item->descripcion_programa,
                    'matricula_pago' => 'NO'
                ]);
            }
        }
    
        return $matriculados;
    }

    public function headings(): array
    {
        return ["ID", "Codigo", "Apellido Paterno", "Apellido Materno", "Nombres", "DNI", "Direccion", "Genero", "Fecha de Nacimiento", "Estado Civil", "Email", "Celular", "Universidad", "Año de Egreso", "Grado Academico", "Especialidad", "Codigo de Constancia", "Programa", "Matriculado"];
    }

    //agregar estilos a las celdas
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // $event->sheet->autoSize();
                $event->sheet->getColumnDimension('A')->setWidth(10);
                $event->sheet->getColumnDimension('B')->setWidth(25);  
                $event->sheet->getColumnDimension('C')->setWidth(40);
                $event->sheet->getColumnDimension('D')->setWidth(40);
                $event->sheet->getColumnDimension('E')->setWidth(40);
                $event->sheet->getColumnDimension('F')->setWidth(25);
                $event->sheet->getColumnDimension('G')->setWidth(50);
                $event->sheet->getColumnDimension('H')->setWidth(25);
                $event->sheet->getColumnDimension('I')->setWidth(25);
                $event->sheet->getColumnDimension('J')->setWidth(25);
                $event->sheet->getColumnDimension('K')->setWidth(40);
                $event->sheet->getColumnDimension('L')->setWidth(25);
                $event->sheet->getColumnDimension('M')->setWidth(50);
                $event->sheet->getColumnDimension('N')->setWidth(25);
                $event->sheet->getColumnDimension('O')->setWidth(25);
                $event->sheet->getColumnDimension('P')->setWidth(25);
                $event->sheet->getColumnDimension('Q')->setWidth(25);
                $event->sheet->getColumnDimension('R')->setWidth(100);
                $event->sheet->getColumnDimension('S')->setWidth(20);
                $event->sheet->getStyle('A1:S1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1:S1')->getFont()->setSize(11);
                $event->sheet->getStyle('A1:S1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('A1:S1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('9dceff');
                $event->sheet->getStyle('A1:S1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
                $event->sheet->getStyle('A1:S1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $event->sheet->setAutoFilter('A1:S1');
                $event->sheet->getStyle('A1:S1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:S1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ];
                // agregar estilo al resto de las celdas
                $event->sheet->getStyle('A2:S'.$event->sheet->getHighestRow())->applyFromArray($styleArray);
                $event->sheet->getStyle('A2:S'.$event->sheet->getHighestRow())->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A2:S'.$event->sheet->getHighestRow())->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                // alinear texto a la izquierda
                $event->sheet->getStyle('A2:A'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('B2:B'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('C2:C'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('C2:D'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('C2:E'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('D2:F'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('E2:G'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('F2:H'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('G2:I'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('H2:J'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('I2:K'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('J2:L'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('K2:M'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('L2:N'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('M2:O'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('N2:P'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('O2:Q'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('P2:R'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('P2:S'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}

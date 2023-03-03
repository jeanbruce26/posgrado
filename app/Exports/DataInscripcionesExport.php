<?php

namespace App\Exports;

use App\Models\InscripcionPago;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Sheet;

class DataInscripcionesExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $inscripcion_pago = InscripcionPago::select('inscripcion.id_inscripcion','persona.nombre_completo','persona.num_doc', 'persona.direccion', 'sexo', 'fecha_naci', 'est_civil.est_civil', 'persona.email', 'persona.celular1', 'univer.universidad', 'persona.año_egreso', 'grado_academico.nom_grado', 'persona.especialidad','pago.nro_operacion','pago.monto','pago.fecha_pago', InscripcionPago::raw('IF(mencion.mencion IS NULL, CONCAT(CONCAT(programa.descripcion_programa," EN "), subprograma.subprograma), CONCAT(CONCAT(CONCAT(CONCAT(programa.descripcion_programa," EN "), subprograma.subprograma)," CON MENCION EN "), mencion.mencion))'))
                                            ->join('inscripcion','inscripcion_pago.inscripcion_id','=','inscripcion.id_inscripcion')
                                            ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                                            ->join('grado_academico','persona.id_grado_academico','=','grado_academico.id_grado_academico')
                                            ->join('est_civil','persona.est_civil_cod_est','=','est_civil.cod_est')
                                            ->join('univer', 'persona.univer_cod_uni','=','univer.cod_uni')
                                            ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                                            ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                                            ->join('programa','subprograma.id_programa','=','programa.id_programa')
                                            ->join('pago','inscripcion_pago.pago_id','=','pago.pago_id')
                                            ->get();
        return $inscripcion_pago;
    }

    public function headings(): array
    {
        return ["ID", "Apellidos y Nombres", "DNI", "Direccion", "Genero", "Fecha de Nacimiento", "Estado Civil", "Email", "Celular", "Universidad", "Año de Egreso", "Grado Academico", "Especialidad", "Nro de Operacion", "Monto", "Fecha de Pago", "Programa"];
    }

    //agregar estilos a las celdas
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // $event->sheet->autoSize();
                $event->sheet->getColumnDimension('A')->setWidth(10);
                $event->sheet->getColumnDimension('B')->setWidth(50);
                $event->sheet->getColumnDimension('C')->setWidth(25);
                $event->sheet->getColumnDimension('D')->setWidth(50);
                $event->sheet->getColumnDimension('E')->setWidth(25);
                $event->sheet->getColumnDimension('F')->setWidth(25);
                $event->sheet->getColumnDimension('G')->setWidth(25);
                $event->sheet->getColumnDimension('H')->setWidth(40);
                $event->sheet->getColumnDimension('I')->setWidth(25);
                $event->sheet->getColumnDimension('J')->setWidth(50);
                $event->sheet->getColumnDimension('K')->setWidth(25);
                $event->sheet->getColumnDimension('L')->setWidth(25);
                $event->sheet->getColumnDimension('M')->setWidth(25);
                $event->sheet->getColumnDimension('N')->setWidth(25);
                $event->sheet->getColumnDimension('O')->setWidth(25);  
                $event->sheet->getColumnDimension('P')->setWidth(25);  
                $event->sheet->getColumnDimension('Q')->setWidth(100);  
                $event->sheet->getStyle('A1:Q1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1:Q1')->getFont()->setSize(11);
                $event->sheet->getStyle('A1:Q1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('A1:Q1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('9dceff');
                $event->sheet->getStyle('A1:Q1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
                $event->sheet->getStyle('A1:Q1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $event->sheet->setAutoFilter('A1:Q1');
                $event->sheet->getStyle('A1:Q1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:Q1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ];
                // agregar estilo al resto de las celdas
                $event->sheet->getStyle('A2:Q'.$event->sheet->getHighestRow())->applyFromArray($styleArray);
                $event->sheet->getStyle('A2:Q'.$event->sheet->getHighestRow())->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A2:Q'.$event->sheet->getHighestRow())->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                // alinear texto a la izquierda
                $event->sheet->getStyle('A2:A'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('B2:B'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('C2:C'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('D2:D'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('E2:E'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('F2:F'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('G2:G'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('H2:H'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('I2:I'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('J2:J'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('K2:K'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('L2:L'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('M2:M'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('N2:N'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('O2:O'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('P2:P'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('Q2:Q'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                
            },
        ];
    }
}

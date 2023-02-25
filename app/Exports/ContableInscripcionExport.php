<?php

namespace App\Exports;

use App\Models\InscripcionPago;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Sheet;

class ContableInscripcionExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
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

    //agregar estilos a las celdas
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // $event->sheet->autoSize();
                $event->sheet->getColumnDimension('A')->setWidth(10);
                $event->sheet->getColumnDimension('B')->setWidth(50);
                $event->sheet->getColumnDimension('C')->setWidth(20);  
                $event->sheet->getColumnDimension('D')->setWidth(25);
                $event->sheet->getColumnDimension('E')->setWidth(20);
                $event->sheet->getColumnDimension('F')->setWidth(20);
                $event->sheet->getColumnDimension('G')->setWidth(80);
                $event->sheet->getStyle('A1:G1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1:G1')->getFont()->setSize(11);
                $event->sheet->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('9dceff');
                $event->sheet->getStyle('A1:G1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
                $event->sheet->getStyle('A1:G1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $event->sheet->setAutoFilter('A1:G1');
                $event->sheet->getStyle('A1:G1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:G1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ];
                // agregar estilo al resto de las celdas
                $event->sheet->getStyle('A2:G'.$event->sheet->getHighestRow())->applyFromArray($styleArray);
                $event->sheet->getStyle('A2:G'.$event->sheet->getHighestRow())->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A2:G'.$event->sheet->getHighestRow())->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                // alinear texto a la izquierda
                $event->sheet->getStyle('A2:A'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('B2:B'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('C2:C'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('D2:D'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('E2:E'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('F2:F'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('G2:G'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                
            },
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\InscripcionPago;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Sheet;

class CoordinadorDataInscripcionesExport implements FromCollection, WithHeadings, WithEvents
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
        $inscripcion_pago = InscripcionPago::select('inscripcion.id_inscripcion','persona.apell_pater', 'persona.apell_mater', 'persona.nombres', 'persona.num_doc', 'persona.celular1', InscripcionPago::raw('IF(persona.celular2 IS NULL, " ", persona.celular2)'),'persona.email',InscripcionPago::raw('IF(persona.email2 IS NULL, " ", persona.email2)'), 'persona.especialidad')
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
        return ["ID", "Apellidos Paterno", "Apellido Materno", "Nombres", "Documento", "Celular", "Celular Opcional", "Correo Electronico", "Correo Electronico Opcional", "Especialidad"];
    }

    //agregar estilos a las celdas
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // $event->sheet->autoSize();
                $event->sheet->getColumnDimension('A')->setWidth(10);
                $event->sheet->getColumnDimension('B')->setWidth(30);
                $event->sheet->getColumnDimension('C')->setWidth(30);
                $event->sheet->getColumnDimension('D')->setWidth(40);
                $event->sheet->getColumnDimension('E')->setWidth(30);  
                $event->sheet->getColumnDimension('F')->setWidth(30);  
                $event->sheet->getColumnDimension('G')->setWidth(30);
                $event->sheet->getColumnDimension('H')->setWidth(40);
                $event->sheet->getColumnDimension('I')->setWidth(40);
                $event->sheet->getColumnDimension('J')->setWidth(40);
                $event->sheet->getStyle('A1:J1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1:J1')->getFont()->setSize(11);
                $event->sheet->getStyle('A1:J1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('A1:J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('9dceff');
                $event->sheet->getStyle('A1:J1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
                $event->sheet->getStyle('A1:J1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $event->sheet->setAutoFilter('A1:J1');
                $event->sheet->getStyle('A1:J1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:J1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ];
                // agregar estilo al resto de las celdas
                $event->sheet->getStyle('A2:J'.$event->sheet->getHighestRow())->applyFromArray($styleArray);
                $event->sheet->getStyle('A2:J'.$event->sheet->getHighestRow())->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A2:J'.$event->sheet->getHighestRow())->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                // alinear texto a la izquierda
                $event->sheet->getStyle('A2:A'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('B2:B'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('B2:C'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('B2:D'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('C2:E'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('D2:F'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('E2:G'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('F2:H'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('G2:I'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('H2:J'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                
            },
        ];
    }
}

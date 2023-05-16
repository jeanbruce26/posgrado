<?php

namespace App\Exports\ModuloAdministrador\Evaluaciones;

use App\Models\Evaluacion;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportData implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $evaluaciones = Evaluacion::select('persona.nombre_completo', 'persona.num_doc', 'evaluacion.p_expediente', 'evaluacion.p_investigacion', 'evaluacion.p_entrevista', 'evaluacion.p_final', DB::raw('IF(evaluacion.evaluacion_estado = 2, "NO ADMITIDO", "ADMITIDO") AS estado'), DB::raw('IF(mencion.mencion IS NULL, CONCAT(CONCAT(programa.descripcion_programa," EN "), subprograma.subprograma), CONCAT(CONCAT(CONCAT(CONCAT(programa.descripcion_programa," EN "), subprograma.subprograma)," CON MENCION EN "), mencion.mencion)) AS programa'))
                                ->join('inscripcion', 'evaluacion.inscripcion_id', '=', 'inscripcion.id_inscripcion')
                                ->join('persona', 'inscripcion.persona_idpersona', '=', 'persona.idpersona')
                                ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                                ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                                ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                                ->orderBy('subprograma.id_subprograma', 'asc')
                                ->orderBy('mencion.id_mencion', 'asc')
                                ->get();
        $data = collect([]);
        $numero = 1;

        foreach($evaluaciones as $item){
            $data->push([
                'nro' => $numero++,
                'nombre_completo' => $item->nombre_completo,
                'num_doc' => $item->num_doc,
                'p_expediente' => $item->p_expediente,
                'p_investigacion' => $item->p_investigacion,
                'p_entrevista' => $item->p_entrevista,
                'p_final' => $item->p_final,
                'estado' => $item->estado,
                'programa' => $item->programa,
            ]);
        }

        return $data;
    }

    public function headings(): array
    {
        return ["Nro", "Apellidos y Nombres", "DNI", "Eva. Expediente", "Eva. Investigacion", "Eva. Entrevista", "Puntaje Final", "Estado", "Programa"];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // $event->sheet->autoSize();
                $event->sheet->getColumnDimension('A')->setWidth(10);
                $event->sheet->getColumnDimension('B')->setWidth(50);
                $event->sheet->getColumnDimension('C')->setWidth(30);
                $event->sheet->getColumnDimension('D')->setWidth(30);
                $event->sheet->getColumnDimension('E')->setWidth(30);
                $event->sheet->getColumnDimension('F')->setWidth(30);
                $event->sheet->getColumnDimension('G')->setWidth(30);
                $event->sheet->getColumnDimension('H')->setWidth(40);
                $event->sheet->getColumnDimension('I')->setWidth(120);  
                $event->sheet->getStyle('A1:I1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1:I1')->getFont()->setSize(11);
                $event->sheet->getStyle('A1:I1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('9dceff');
                $event->sheet->getStyle('A1:I1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
                $event->sheet->getStyle('A1:I1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $event->sheet->setAutoFilter('A1:I1');
                $event->sheet->getStyle('A1:I1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:I1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ];
                // agregar estilo al resto de las celdas
                $event->sheet->getStyle('A2:I'.$event->sheet->getHighestRow())->applyFromArray($styleArray);
                $event->sheet->getStyle('A2:I'.$event->sheet->getHighestRow())->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A2:I'.$event->sheet->getHighestRow())->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                // alinear texto a la izquierda
                $event->sheet->getStyle('A2:A'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('B2:B'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('C2:C'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('D2:D'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('E2:E'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('F2:F'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('G2:G'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('H2:H'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('I2:I'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            },
        ];
    }
}

<?php

namespace App\Exports\ModuloAdministrador\Admitidos;

use App\Models\Admitidos;
use App\Models\MatriculaPago;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportAdmitidosNoMatriculados implements FromCollection, WithTitle, WithHeadings, WithEvents
{
    protected $id_mencion;

    public function __construct($id_mencion)
    {
        $this->id_mencion = $id_mencion;
    }

    public function collection()
    {
        $admitidos = Admitidos::join('persona', 'admitidos.persona_id', '=', 'persona.idpersona')
                ->join('mencion', 'admitidos.id_mencion', '=', 'mencion.id_mencion')
                ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                ->select('admitidos.admitidos_id', 'admitidos.admitidos_codigo', 'persona.apell_pater', 'persona.apell_mater', 'persona.nombres', 'persona.num_doc', 'persona.celular1', MatriculaPago::raw('IF(persona.celular2 IS NULL, " ", persona.celular2)'),'persona.email',MatriculaPago::raw('IF(persona.email2 IS NULL, " ", persona.email2)'))
                ->where('admitidos.id_mencion', $this->id_mencion)
                ->orderBy('persona.nombre_completo', 'asc')
                ->get();

        $matriculados = MatriculaPago::join('admitidos', 'matricula_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                ->join('persona', 'admitidos.persona_id', '=', 'persona.idpersona')
                ->join('mencion', 'admitidos.id_mencion', '=', 'mencion.id_mencion')
                ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                ->select('admitidos.admitidos_id', 'admitidos.admitidos_codigo', 'persona.apell_pater', 'persona.apell_mater', 'persona.nombres', 'persona.num_doc', 'persona.celular1', MatriculaPago::raw('IF(persona.celular2 IS NULL, " ", persona.celular2)'),'persona.email',MatriculaPago::raw('IF(persona.email2 IS NULL, " ", persona.email2)'))
                ->where('admitidos.id_mencion', $this->id_mencion)
                ->orderBy('persona.nombre_completo', 'asc')
                ->get();

        $data = collect($admitidos)->diff($matriculados);
    
        return $data;
    }

    public function headings(): array
    {
        return ["ID", "Código Posgrado", "Apellido Paterno",  "Apellido Materno", "Nombres", "Documento", "Celular", "Celular Opcional", "Correo Electronico", "Correo Electronico Opcional"];
    }

    //agregar estilos a las celdas
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // $event->sheet->autoSize();
                $event->sheet->getColumnDimension('A')->setWidth(10);
                $event->sheet->getColumnDimension('B')->setWidth(25);
                $event->sheet->getColumnDimension('C')->setWidth(30);
                $event->sheet->getColumnDimension('D')->setWidth(30);
                $event->sheet->getColumnDimension('E')->setWidth(35);
                $event->sheet->getColumnDimension('F')->setWidth(25);  
                $event->sheet->getColumnDimension('G')->setWidth(35);
                $event->sheet->getColumnDimension('H')->setWidth(35);
                $event->sheet->getColumnDimension('I')->setWidth(35);
                $event->sheet->getColumnDimension('J')->setWidth(35);
                $event->sheet->getStyle('A1:J1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1:J1')->getFont()->setSize(11);
                $event->sheet->getStyle('A1:J1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12
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
                $event->sheet->getStyle('C2:C'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('D2:D'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('E2:E'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('F2:F'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('G2:G'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('H2:H'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('I2:I'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('J2:J'.$event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            },
        ];
    }

    public function title(): string
    {
        return 'NO MATRICULADOS';
    }
}

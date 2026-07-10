<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class CucExport implements FromView, ShouldAutoSize, WithEvents, WithStyles
{
    use Exportable;

    public function __construct(public $cucs)
    {
    }


    public function styles(Worksheet $sheet)
    {
        $lastColumn     = $sheet->getHighestColumn();
        $headerColor    = 'ffff00';

        // Estilo de encabezado
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000']
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'rgb' => $headerColor
                ]
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        // Aplicar estilo a los encabezados
        $sheet->getStyle("A1")->applyFromArray($headerStyle);
        $sheet->getStyle("B1")->applyFromArray($headerStyle);
        // Negrita
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $lastColumn = $event->sheet->getHighestColumn();
            }
        ];
    }

    public function view(): View
    {
        $cucs = $this->cucs;
        return view('pages.excel.cuc', compact('cucs'));
    }
}

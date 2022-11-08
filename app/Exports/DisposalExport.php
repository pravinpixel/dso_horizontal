<?php

namespace App\Exports;

use App\Helpers\LogActivity;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DisposalExport  implements FromArray , WithHeadings, WithStyles, WithEvents
{
    public function styles(Worksheet $sheet)
    { 
        return [
            1    => ['font' => ['bold' => true]],
        ];

    }
    
    public function array():array
    {
        $data = LogActivity::getDisposalItems();
        return $data;
    }
    public function headings() :array
    { 
        return [
            "Transaction Date",
            "Transaction Time",
            "Transaction by",
            "Item Description",
            "Batch Serial",
            "Unit Pack Value",
            "Quantity"
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(20);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(20);  
            },
        ];
    }
}

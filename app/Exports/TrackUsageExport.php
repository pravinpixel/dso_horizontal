<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TrackUsageExport  implements FromArray , WithHeadings, WithStyles, WithEvents
{
    protected $data;

    public function __construct( $data)
    {
        $this->data = $data;
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function array():array
    {
        return $this->data;
    }
    public function headings() :array
    {
        return [
            "Item Description",
            "Brand",
            "Batch/Serial",
            "Unit packing value",
            "Storage area",
            "Housing",
            "Owners	",
            "Transaction Date",
            "Transaction Time",
            "Transaction By	",
            "Used Amt",
            "Remaining amt ",
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
            },
        ];
    }
}

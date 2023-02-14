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
        foreach ($this->data as $key => $value) {
            unset($this->data[$key]['id']);
            unset($this->data[$key]['batch_id']);
            unset($this->data[$key]['barcode_number']);
            unset($this->data[$key]['quantity']);
            unset($this->data[$key]['remarks']);
            unset($this->data[$key]['created_at']);
            unset($this->data[$key]['updated_at']);
        }
        return $this->data;
    }
    public function headings() :array
    {
        return [
            "Item description",
            "Batch/Serial",
            "Transacted by	",
            "Used Amt",
            "Remaining amt ",
            "Brand",
            "Unit packing value",
            "Storage area",
            "Housing",
            "Owners	",
            "Transaction Date",
            "Transaction Time",
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

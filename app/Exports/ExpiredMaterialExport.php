<?php

namespace App\Exports;

use App\Helpers\LogActivity;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExpiredMaterialExport  implements FromArray , WithHeadings, WithStyles, WithEvents
{
    protected $data;

    public function __construct($data)
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
        securityLog('Expired Material Report Export');
        return $this->data;
    }
    public function headings() :array
    { 
        return [
            "Category selection",
            "Item description",
            "Batch serial",
            "Unit packing value",
            "Quantity",
            "Storage area",
            "Housing",
            "Date of expiry",
            "Used for td expt only",
            "Department",
            "Owners"
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
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(20);  
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(20);  
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(20);  
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(20);  
            },
        ];
    }
}
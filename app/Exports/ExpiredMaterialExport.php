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
    protected $start_date;
    protected $end_date;

    public function __construct( $start_date , $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date   = $end_date;
    }
    public function styles(Worksheet $sheet)
    { 
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
    
    public function array():array
    {
        $rangeStart = strtotime($this->start_date);
        $rangeEnd   = strtotime($this->end_date);
        $data       = getExpiredMaterials();
 
        $filtered_events = array_filter($data, function($var) use ($rangeStart, $rangeEnd) {  
            $evtime = strtotime($var['created_at']->format('Y-m-d')); 
            return $evtime <= $rangeEnd && $evtime >= $rangeStart;  
        }); 
        return $filtered_events;
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
            "Owners",
            "Created At"
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
                $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(20);  
            },
        ];
    }
}

<?php

namespace App\Exports;

use App\Helpers\LogActivity;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HistoryExport  implements FromArray , WithHeadings, WithStyles, WithEvents
{
    public function styles(Worksheet $sheet)
    { 
        return [
            1    => ['font' => ['bold' => true]],
        ];

    }
    
    public function array():array
    {
        $data   = LogActivity::all();
        $result = [];

        foreach ($data as $key => $row) {
            $result[] = [
                "S.No"             => $key + 1,
                "Transaction Date" => $row->created_at->format('Y-m-d'),
                "Transaction Time" => $row->created_at->format('h:m A'),
                "Transacted"   => $row->user_name,
                "Module"           => $row->module_name,
                "Action Taken"     => $row->action_type,
                "Comments"         => $row->remarks != null && $row->remarks != '' ? $row->remarks : '-'
            ];
        }
        return $result;
    }
    public function headings() :array
    { 
        return [
            "S.No",
            "Transaction Date",
            "Transaction Time",
            "Transacted",
            "Module",
            "Action Taken",
            "Comments",
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(20);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(50);  
            },
        ];
    }
}

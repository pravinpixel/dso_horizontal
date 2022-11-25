<?php

namespace App\Exports;

use App\Helpers\LogActivity;
use App\Models\Batches;
use App\Models\DisposedItems;
use App\Models\MaterialProducts;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DisposalExport  implements FromArray , WithHeadings, WithStyles, WithEvents
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
        if(is_null($this->start_date) || is_null($this->end_date)) {
            return DisposedItems::select(
                "TransactionDate",
                "TransactionTime",
                "TransactionBy",
                "ItemDescription",
                "BatchSerial",
                "UnitPackingValue",
                "Quantity"
            )->get()->toArray();
        }
        $start_date = Carbon::parse($this->start_date);
        $end_date   = Carbon::parse($this->end_date);
        securityLog('Disposal Items Export');
        return DisposedItems::whereDate('created_at','<=',$end_date)->whereDate('created_at','>=',$start_date)->get();
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

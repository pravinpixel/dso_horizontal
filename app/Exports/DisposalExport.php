<?php

namespace App\Exports;

use App\Helpers\LogActivity;
use App\Models\Batches;
use App\Models\MaterialProducts;
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
        $rangeStart = strtotime($this->start_date);
        $rangeEnd   = strtotime($this->end_date);
   
   
        $data =  Batches::where('quantity',0)->latest()->get();
 
        $disposed = [];
        foreach ($data as $key => $batch) {
            if($batch->quantity == 0) {
                $disposed[] = [
                    "transaction_date" => $batch->created_at->format('d-m-Y'),
                    "transaction_time" => $batch->created_at->format('h:m:s A'),
                    "transaction_by"   => $batch->user_name,
                    "item_description" => MaterialProducts::find($batch->material_product_id)->item_description,
                    "batch_serial"     => $batch->batch.' / '.$batch->serial,
                    "unit_pack_value"  => $batch->unit_packing_value,
                    "quantity"         => (string) $batch->quantity, 
                ];
            }
        }

        $filtered_events = array_filter($disposed, function($var) use ($rangeStart, $rangeEnd) {  
            $evtime = strtotime($var['transaction_date']); 
            return $evtime <= $rangeEnd && $evtime >= $rangeStart;  
        }); 
       
        securityLog('Disposal Items Export');
        return $filtered_events;
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

<?php

namespace App\Exports;

use App\Models\Batches;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReconciliationExport implements FromArray, WithHeadings , ShouldAutoSize, WithStyles
{
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]] 
        ];
    } 
    public function array(): array
    {
        $ListOfBatches = [];
        foreach (Batches::where('is_draft',0)->where('quantity','!=',0)->get() as $key => $batch) {
            $ListOfBatches[] = [
                'no'               => $key + 1,
                'item_description' => $batch->BatchMaterialProduct->item_description ?? '',
                'barcode_number'   => $batch->barcode_number,
                'brand'            => $batch->brand,
                'batch_serial'     => $batch->batch." / ".$batch->serial,
                'quantity'         => $batch->quantity,
            ];
        }
        securityLog('Reconciliation Sample Data Download');
        return $ListOfBatches;
    }
    public function headings(): array
    {   
        return [
            "S.No",
            "Item Description ",
            "Barcode Number",
            "Brand",
            "Batch/Serial",
            "System Stock",
            "Physical Stock",
            "Remarks"
        ];
    }
}
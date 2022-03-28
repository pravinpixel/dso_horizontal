<?php

namespace App\Imports;

use App\Models\MaterialProducts;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BulkImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         
        return new MaterialProducts([
            'barcode_number'                => $row['barcode_number'],
            'category_selection'            => $row['category_selection'],
            'item_description'              => $row['item_description'],
            'in_house_product_logsheet_id'  => $row['in_house_product_logsheet_id'],
            'brand'                         => $row['brand'],
            'supplier'                      => $row['supplier'],
            'unit_packing_size'             => $row['unit_packing_size'],
            'quantity'                      => $row['quantity'],
            'batch'                         => $row['batch'],
            'serial'                        => $row['serial'],
            'po_number'                     => $row['po_number'],
        ]);
        
    }
}

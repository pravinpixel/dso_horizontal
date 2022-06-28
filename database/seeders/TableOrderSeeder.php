<?php

namespace Database\Seeders;

use App\Models\tableOrder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class TableOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parentTable            =   Schema::getColumnListing("material_products");
        $childTable             =   Schema::getColumnListing("batches");
        $allColumns             =   array_merge($parentTable, $childTable);
        $tableColumns           =   array_combine($allColumns,$allColumns );  
        unset(
            $tableColumns['id'], 
            $tableColumns['created_at'], 
            $tableColumns['item_description'],
            $tableColumns['updated_at'], 
            $tableColumns['deleted_at'],
            $tableColumns['is_draft'],
            $tableColumns['coc_coa_mill_cert_status'],
            $tableColumns['actions'],
            $tableColumns['end_of_batch'],
            $tableColumns['access'],
            $tableColumns['coc_coa_mill_cert'],
            $tableColumns['iqc_result'],
            $tableColumns['iqc_status'],
            $tableColumns['cas'],
            $tableColumns['fm_1202'],
            $tableColumns['remarks'],
            $tableColumns['extended_qc_result'],
            $tableColumns['disposal_certificate'],
        );
        $i = 0;
        foreach($tableColumns as $key => $value) { 
            tableOrder::create([
                'order_by'      => $i + 1,
                'column'        => $value,
                'status'        => true
            ]);
            $i++;
        }
    }
}
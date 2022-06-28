<?php

namespace Database\Seeders;

use App\Models\tableOrder;
use Illuminate\Database\Seeder;
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
            $tableColumns['end_of_batch']
        );
        
        tableOrder::create([
            'column' => json_encode($tableColumns)
        ]);
    }
}
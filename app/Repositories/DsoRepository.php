<?php

namespace App\Repositories;

use App\Interfaces\DsoRepositoryInterface;
use App\Models\Masters\Departments;
use App\Models\Masters\HouseTypes;
use App\Models\Masters\PackingSizeData;
use App\Models\Masters\StatutoryBody;
use App\Models\Masters\StorageRoom;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class DsoRepository implements DsoRepositoryInterface
{
    public function renderPage($page_name, $view)
    {
        $storage_room_db        =   StorageRoom::all();
        $departments_db         =   Departments::all();
        $statutory_body_db      =   StatutoryBody::all();
        $house_type_db          =   HouseTypes::all();
        $unit_packing_size_db   =   PackingSizeData::all();
        $owners                 =   User::all();
        $parentTable            =   Schema::getColumnListing("material_products");
        $childTable             =   Schema::getColumnListing("batches");
        $allColumns             =   array_merge($parentTable, $childTable);
        $tableColumns           =   array_combine($allColumns  ,$allColumns ); 

        unset(
            $tableColumns['id'], 
            $tableColumns['created_at'], 
            $tableColumns['item_description'], 
            $tableColumns['updated_at'], 
            $tableColumns['deleted_at'],
            $tableColumns['is_draft'],
        );

        $tableAllColumns = [];
        foreach ($tableColumns as $key => $value) {
            if($value == "unit_of_measure" || $value == "housing_type" || $value == "department")  {
                $tableAllColumns[$key] = [
                    "name"      => $key,
                    "row"       => '{{ row.'.$value.'.name }}',
                    "batch"     => '{{ batch.'.$value.'.name }}',
                ];
            } else {
                $tableAllColumns[$key] = [
                    "name"      => $key,
                    "row"       => '{{ row.'.$value.' }}',
                    "batch"     => '{{ batch.'.$value.' }}',
                ];
            }
        }

        $table_th_columns        = view('crm.partials.table-th-column', compact('tableAllColumns','page_name'));
        $table_td_columns        = view('crm.partials.table-td-column', compact('tableAllColumns','page_name'));
        $batch_table_td_columns  = view('crm.partials.batch-table-td-column', compact('tableAllColumns','page_name'));
        forget_session();

        return view($view,
        compact(
            'table_th_columns',
            'table_td_columns', 
            'batch_table_td_columns',
            'owners',
            'storage_room_db',
            'departments_db',
            'statutory_body_db',
            'house_type_db',
            'unit_packing_size_db',
            'tableAllColumns',
            'page_name'
        ));
    }
}
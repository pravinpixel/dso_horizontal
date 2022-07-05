<?php

namespace App\Repositories;

use App\Interfaces\DsoRepositoryInterface;
use App\Models\Masters\Departments;
use App\Models\Masters\HouseTypes;
use App\Models\Masters\PackingSizeData;
use App\Models\Masters\StatutoryBody;
use App\Models\Masters\StorageRoom;
use App\Models\tableOrder;
use App\Models\User;
use Illuminate\Support\Facades\Log;
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
        $tableColumns           =   tableOrder::getTableColumn();
        $tableAllColumns        =   [];
        Log::info($tableColumns);
        foreach ($tableColumns as $key => $value) {
            if($value['name'] == "unit_of_measure" || $value['name'] == "housing_type" || $value['name'] == "department" || $value['name'] == "storage_area")  {
                $tableAllColumns[$key] = [
                    "status"    => $value['status'],
                    "name"      => $key,
                    "row"       => '{{ row.'.$value['name'].'.name }}',
                    "batch"     => '{{ batch.'.$value['name'].'.name }}',
                ];
            }elseif( $value['name'] == 'used_for_td_expt_only') {
                $tableAllColumns[$key] = [
                    "status"    =>  $value['status'],
                    "name"      =>  $key,
                    "row"       =>  '{{ row.'.$value['name'].'.name }}',
                    "batch"     =>  '
                        <span class="badge badge-outline-success rounded-pill" ng-if="batch.'.$value['name'].' == '."1".' == true">
                            Yes
                        </span>
                        <span class="badge badge-outline-secondary rounded-pill" ng-if="batch.'.$value['name'].' == '."1".' != true">
                            No
                        </span>
                    ',
                ];
            }
            elseif($value['name'] =="date_of_expiry")  {
                $tableAllColumns[$key] = [
                    "status"    => $value['status'],
                    "name"      => $key,
                    "row"       => '{{ row.'.$value['name'].' }}',
                    "batch"     => '
                        {{ batch.'.$value['name'].'}}
                        <i class="ms-1 text-{{ batch.'.$value['name'].' >= '."current_date".' == true ? '."'success'".' : '."'danger'".'}} dot-sm bi bi-circle-fill"></i>
                    '
                ];
            } else {
                $tableAllColumns[$key] = [
                    "status"    => $value['status'],
                    "name"      => $key,
                    "row"       => '{{ row.'.$value['name'].' }}',
                    "batch"     => '{{ batch.'.$value['name'].' }}',
                ];
            }
        } 

        $table_th_columns        = view('crm.partials.table-th-column', compact('tableAllColumns','page_name'));
        $table_td_columns        = view('crm.partials.table-td-column', compact('tableAllColumns','page_name'));
        $batch_table_td_columns  = view('crm.partials.batch-table-td-column', compact('tableAllColumns','page_name'));
        forget_session(); 
        return view($view, compact(
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
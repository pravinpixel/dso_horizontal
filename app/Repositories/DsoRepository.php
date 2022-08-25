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
use Illuminate\Support\Arr;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
        request()->session()->put('page_name', $page_name); 
 
        foreach ($tableColumns as $key => $value) {
            if($value['name'] == "unit_of_measure" || $value['name'] == "housing_type" || $value['name'] == "department" || $value['name'] == "storage_area")  {
                $tableAllColumns[$key] = [
                    "status"    => $value['status'],
                    "name"      => $key,
                    "row"       => '{{ row.'.$value['name'].'.name }}',
                    "batch"     => '{{ batch.'.$value['name'].'.name }}',
                ];
            }elseif( $value['name'] == 'used_for_td_expt_only' ||  $value['name'] == 'euc_material' ||$value['name'] == 'require_bulk_volume_tracking' ||$value['name'] == 'require_outlife_tracking' ) {
                $tableAllColumns[$key] = [
                    "status"    =>  $value['status'],
                    "name"      =>  $key,
                    "row"       =>  '{{ row.'.$value['name'].'.name }}',
                    "batch"     =>  '
                        <span class="badge mx-auto badge-outline-success rounded-pill" ng-if="batch.'.$value['name'].' == '."1".' == true">Yes</span>
                        <span class="badge mx-auto badge-outline-danger rounded-pill" ng-if="batch.'.$value['name'].' == '."1".' != true">No</span>
                    ',
                ];
            }
            else {
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
        forgot_session(); 
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
    public function renderTableData($material_product)
    {
        $page_name = session()->get('page_name');

        foreach ($material_product as $key => $parent) {
            $quantityColor       = 'text-danger';
            $QtyCount            = 0;
            $readCount           = 0;
            $draftBatchCount     = 0;
            $UnitPackingCount    = 0; 
            
            foreach ($parent->Batches as $batch_key => $batch) {

                if($page_name === 'THRESHOLD_QTY') {
                    if($batch->is_read != 0) {
                        unset($parent->Batches[$batch_key]);
                    }
                }

                if ($batch->is_draft == 1 ) {
                    $draftBatchCount += 1 ;
                } else {
                    $QtyCount         += $batch->quantity;
                    $UnitPackingCount += $batch->unit_packing_value;
                }
                if($batch->quantity  != null) {
                    $batch->quantity = str_replace('.00', '' , $batch->quantity);
                }
            }
            // dd($readCount);
            $parent['totalQuantity']           = $QtyCount;
            $parent['totalUnitPackValue']      = $UnitPackingCount;
            $parent['hideParentRow']           = $parent->Batches->count() == $draftBatchCount ?  1 : 0;
            $parent['hideParentRowReadStatus'] = $readCount == 0 ? 1 : 0;
          
            if($parent->totalQuantity < $parent->alert_threshold_qty_lower_limit) {
                $quantityColor = 'text-danger';
            } else {
                if($parent->alert_threshold_qty_lower_limit < ($parent->quantity) &&  ($parent->alert_threshold_qty_upper_limit) > ($parent->quantity)) {
                    $quantityColor = 'text-warning';
                } else {
                    if($parent->totalQuantity > $parent->alert_threshold_qty_upper_limit) {
                        $quantityColor = 'text-success';
                    } else {
                        $quantityColor = 'text-warning';
                    }
                } 
            }
            $parent['quantityColor']      = $quantityColor;
        }

       
        $collection = Arr::flatten($material_product);
        $items      = collect($collection);
        $perPage    = 5;
        $page       = null;
        $page       = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items      = $items instanceof Collection ? $items : Collection::make($items); 

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path'     => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => "page",
        ]);
    }
}
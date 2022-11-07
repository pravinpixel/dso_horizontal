<?php

namespace App\Repositories;

use App\Interfaces\DsoRepositoryInterface;
use App\Models\Masters\Departments;
use App\Models\Masters\HouseTypes;
use App\Models\Masters\PackingSizeData;
use App\Models\Masters\StatutoryBody;
use App\Models\Masters\StorageRoom;
use App\Models\MaterialProducts;
use App\Models\tableOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

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
            elseif($value['name'] == 'date_of_manufacture' || $value['name'] == 'date_of_expiry' || $value['name'] == 'date_of_shipment'  || $value['name'] == 'extended_expiry') {
                $tableAllColumns[$key] = [
                    "status"    => $value['status'],
                    "name"      => $key,
                    "row"       => '{{ row.'.$value['name'].' }}',
                    "batch"     => '{{ batch.'.$value['name'].' | date:"MM/dd/yyyy" }}',
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
            $readCount           = 0;
            $draftBatchCount     = 0;
            $UnitPackingCount    = 0;
            $total_bath_quantity = 0;
            
            foreach ($parent->Batches as $batch_key => $batch) { 
               
                $date_of_expiry             = $batch->date_of_expiry;
                $batch->date_in             = Carbon::parse($batch->date_in)->format('d/m/Y') ;
                $batch->date_of_expiry      = Carbon::parse($batch->date_of_expiry)->format('d/m/Y') ;
                $batch->date_of_manufacture = Carbon::parse($batch->date_of_manufacture)->format('d/m/Y') ;
                $batch->date_of_shipment    = Carbon::parse($batch->date_of_shipment)->format('d/m/Y') ;
              
                  
                $diff = Carbon::parse($date_of_expiry)->diffInDays();

                if($diff < 0) {
                    $batch->date_of_expiry_color = "text-danger";
                }

                if ($diff < 21) { // 21 ---> 3 weeks
                    $batch->date_of_expiry_color = "text-warning";
                }
                if ($diff > 21) { // 21 ---> 3 weeks
                    $batch->date_of_expiry_color = "text-success";
                }

                if ($batch->is_draft == 1 ) {
                    $draftBatchCount += 1; 
                } else { 
                    $QtyCount            = $parent->Batches[0]->quantity;
                    $totalQtyCount       = $parent->Batches[0]->quantity *  $parent->Batches[0]->unit_packing_value;
                    $UnitPackingCount    = $parent->Batches[0]->unit_packing_value;
                    $total_bath_quantity += (int) $batch->quantity;
                }
 
                if($page_name == 'THRESHOLD_QTY') { 
                    if($batch->is_draft == 1) {
                        unset($parent->Batches[$batch_key]);
                    }
                } elseif($page_name == 'PRINT_BARCODE_LABEL') {
                    if($batch->is_draft == 1) {
                        unset($parent->Batches[$batch_key]);
                    }
                }
            }
            $parent['totalQuantity']           = $QtyCount;
            $parent['totalQuantityUnit']       = $totalQtyCount;
            $parent['totalUnitPackValue']      = $UnitPackingCount;
            $parent['hideParentRow']           = $parent->Batches->count() == $draftBatchCount ?  1 : 0;
            $parent['hideParentRowReadStatus'] = $readCount == 0 ? 1 : 0;
            $parent['draftBatchCount']         = $draftBatchCount;
            $parent['total_bath_quantity']     = $total_bath_quantity;
          
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

            $parent['quantityColor'] = $quantityColor;
            
            if($page_name == 'THRESHOLD_QTY') { 
                if($parent['quantityColor'] == 'text-success') {
                    unset($material_product[$key]);
                }
            } elseif($page_name == 'PRINT_BARCODE_LABEL') {
                if($draftBatchCount != 0) {
                    unset($material_product[$key]);
                }
            }
        }

       $access_material_product = $material_product;
       
        foreach ($access_material_product as $material_index => $material) {
            foreach ($material->Batches as $batch_index => $batch) {
                if(auth_user_role()->slug == 'staff') {
                    $access = json_decode($batch->access);
                    if(isset($access)) {
                        if(in_array(auth_user()->id,$access) == false) {
                            unset($access_material_product[$material_index]->Batches[$batch_index]);
                        }
                    }
                }
            }
            if(count($material->Batches) == 0) {
                unset($access_material_product[$material_index]);
            }
        }
        
        $collection = Arr::flatten($access_material_product);
        $items      = collect($collection);
        $perPage    = config('app.paginate');
        $page       = null;
        $page       = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items      = $items instanceof Collection ? $items : Collection::make($items); 

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path'     => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => "page",
        ]);
    }
}
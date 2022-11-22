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
            $material_total_quantity = 0;
            
            foreach ($parent->Batches as $batch_key => $batch) { 
               
                $date_of_expiry             = $batch->date_of_expiry;
                $batch->date_in             = !is_null($batch->date_in) ? Carbon::parse($batch->date_in)->format('d/m/Y') : '';
                $batch->date_of_expiry      = !is_null($batch->date_of_expiry) ? Carbon::parse($batch->date_of_expiry)->format('d/m/Y') : '';
                $batch->date_of_manufacture = !is_null($batch->date_of_manufacture) ? Carbon::parse($batch->date_of_manufacture)->format('d/m/Y') : '';
                $batch->date_of_shipment    = !is_null($batch->date_of_shipment) ? Carbon::parse($batch->date_of_shipment)->format('d/m/Y') : '';
                
                $owners = "";
                
                if($batch->owners) {
                    foreach ($batch->BatchOwners as $key => $owner) { 
                        $owners .= '<small class="badge mb-1 me-1 badge-outline-dark shadow-sm bg-light rounded-pill">'.$owner->alias_name.'</small>';
                    }
                }
                
                $batch->owners = $owners; 
                
                if(!is_null($date_of_expiry)) {
                    $diff          = Carbon::parse($date_of_expiry)->diffInDays();
                    $days_of_alert = $batch->BatchMaterialProduct->alert_before_expiry * 7;
                    
                    if($diff > $days_of_alert) {
                        $batch->date_of_expiry_color = "text-success";
                    } else {
                        if($diff == $days_of_alert) {
                            $batch->date_of_expiry_color = "text-warning";
                        } else {
                            $batch->date_of_expiry_color = "text-danger";
                        }
                    } 
                }

                if ($batch->is_draft == 1 ) {
                    $draftBatchCount += 1; 
                } else { 
                    $total_bath_quantity     += (int) $batch->quantity;
                    $material_total_quantity += $batch->quantity * $batch->unit_packing_value;
                    $batch->total_quantity    = $batch->quantity * $batch->unit_packing_value;
                }

                if($page_name != 'REPORT_DISPOSED_ITEMS') {
                    if($batch->quantity == 0) {
                        unset($parent->Batches[$batch_key]);
                    }
                }
                 
                if($page_name == 'THRESHOLD_QTY') { 
                    Log::info($batch->quantity_color);
                    if($batch->is_draft == 1 && $batch->quantity_color == 'GREEN') {
                        unset($parent->Batches[$batch_key]);
                    }
                } elseif($page_name == 'PRINT_BARCODE_LABEL') {
                    if($batch->is_draft == 1) {
                        unset($parent->Batches[$batch_key]);
                    }
                } elseif ($page_name == 'EXTEND_EXPIRY') { 
                    if($batch->iqc_status == 1 || $batch->is_draft == 1) {
                        unset($parent->Batches[$batch_key]);
                    }
                } elseif ($page_name == 'REPORT_DISPOSED_ITEMS') {
                    if($batch->quantity != 0) {
                        unset($parent->Batches[$batch_key]);
                    }
                } elseif($page_name == 'EARLY_DISPOSAL') {
                    if($batch->is_draft == 1) {
                        unset($parent->Batches[$batch_key]);
                    }
                } elseif($page_name == 'DEDUCT_TRACK_OUTLIFE_REPORT') {
                    if($batch->is_draft == 1 || $batch->withdrawal_type != 'DEDUCT_TRACK_OUTLIFE') {
                        unset($parent->Batches[$batch_key]);
                    }
                } 
            }
           
            $parent['material_total_quantity'] = $material_total_quantity;
            $parent['material_quantity']       = $material_total_quantity != 0 ? ( $material_total_quantity / $parent['unit_packing_value'] ): 0;
     
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
                    $access     = json_decode($batch->access);  
                   
                    if(isset($access)) {
                        if(in_array(auth_user()->id,$access) == false) {
                            unset($access_material_product[$material_index]->Batches[$batch_index]);
                        } 
                    }
                    if(count($batch->BatchOwners)) {   
                        if(in_array(auth_user()->id, Arr::pluck($batch->BatchOwners->toArray(), 'user_id')) == false) { 
                            $batch->permission = 'READ_ONLY';
                        } else {
                            $batch->permission = 'READ_AND_WRITE';
                        }
                    } 
                } else {
                    $batch->permission = 'READ_AND_WRITE';
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
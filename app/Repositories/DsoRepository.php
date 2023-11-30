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
use DateTime;
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

            if ($value['name'] == "unit_of_measure" || $value['name'] == "housing_type" || $value['name'] == "department" || $value['name'] == "storage_area") {
                $tableAllColumns[$key] = [
                    "status"    => $value['status'],
                    "name"      => $key,
                    "row"       => '{{ row.' . $value['name'] . '.name }}',
                    "batch"     => '{{ batch.' . $value['name'] . '.name }}',
                ];
            } elseif ($value['name'] == 'used_for_td_expt_only' ||  $value['name'] == 'euc_material' || $value['name'] == 'require_bulk_volume_tracking' || $value['name'] == 'require_outlife_tracking') {
                $tableAllColumns[$key] = [
                    "status"    =>  $value['status'],
                    "name"      =>  $key,
                    "row"       =>  '{{ row.' . $value['name'] . '.name }}',
                    "batch"     =>  '
                        <span class="badge mx-auto badge-outline-success rounded-pill" ng-if="batch.' . $value['name'] . ' == ' . "1" . ' == true">Yes</span>
                        <span class="badge mx-auto badge-outline-danger rounded-pill" ng-if="batch.' . $value['name'] . ' == ' . "1" . ' != true">No</span>
                    ',
                ];
            } elseif ($value['name'] == 'date_of_manufacture' || $value['name'] == 'date_of_expiry'|| $value['name'] == 'disposed_after' || $value['name'] == 'date_of_shipment'  || $value['name'] == 'extended_expiry') {
                $tableAllColumns[$key] = [
                    "status"    => $value['status'],
                    "name"      => $key,
                    "row"       => '{{ row.' . $value['name'] . ' }}',
                    "batch"     => '{{ batch.' . $value['name'] . ' | date:"MM/dd/yyyy" }}',
                ];
            } else {
                $tableAllColumns[$key] = [
                    "status"    => $value['status'],
                    "name"      => $key,
                    "row"       => '{{ row.' . $value['name'] . ' }}',
                    "batch"     => '{{ batch.' . $value['name'] . ' }}',
                ];
            }
        }

        $table_th_columns        = view('crm.partials.table-th-column', compact('tableAllColumns', 'page_name'));
        $table_td_columns        = view('crm.partials.table-td-column', compact('tableAllColumns', 'page_name'));
        $batch_table_td_columns  = view('crm.partials.batch-table-td-column', compact('tableAllColumns', 'page_name'));
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
    public function renderTableData($material_product, $config = null)
    {
        $page_name = is_null($config) ? session()->get('page_name') : $config['page_name']; 
        foreach ($material_product as $key => $parent) { 
            $readCount        = 0;
            $draftBatchCount  = 0;
            $UnitPackingCount = 0;

            foreach ($parent->Batches as $batch_key => $batch) {
                $date_of_expiry             = $batch->date_of_expiry;
                $batch->date_in             = SetDateFormat($batch->date_in);
                $batch->date_of_expiry      = SetDateFormat($batch->date_of_expiry);
                $batch->date_of_manufacture = SetDateFormat($batch->date_of_manufacture);
                $batch->date_of_shipment    = SetDateFormat($batch->date_of_shipment);
                 $batch->disposed_after    = SetDateFormat($batch->disposed_after);

                if ($batch->owners) {
                    $owners = "";
                    foreach ($batch->BatchOwners as $key => $owner) {
                        $owners .= '<small class="badge mb-1 me-1 badge-outline-dark shadow-sm bg-light rounded-pill">' . $owner->alias_name . '</small>';
                    }
                    $batch->owners = $owners;
                }


                if (!is_null($date_of_expiry)) {

                    $DateOfExpiry   = new DateTime(date('Y-m-d', strtotime($date_of_expiry)));
                    $CurrentDate    = new DateTime(date('Y-m-d'));

                    if($CurrentDate > $DateOfExpiry) { //Expired 'RED'
                        $DateOfExpiryStatus = "text-danger";
                    } elseif($CurrentDate == $DateOfExpiry){
                        $DateOfExpiryStatus = "text-warning";
                    } else {
                        $FinalDateOfExpiry = date_create($date_of_expiry);
                        $alertWeeks        = $batch->BatchMaterialProduct->alert_before_expiry." Weeks"; //1 week
                        if($batch->BatchMaterialProduct->alert_before_expiry) {
                            date_sub($FinalDateOfExpiry,date_interval_create_from_date_string($alertWeeks));
                            $CurrentExpiryFinalDate = date_format($FinalDateOfExpiry,"Y-m-d");
                            if($CurrentExpiryFinalDate > date('Y-m-d')) {
                                $DateOfExpiryStatus = "text-success";
                            }  else {
                                $DateOfExpiryStatus = "text-warning";
                            }
                        } else {
                            $DateOfExpiryStatus = "text-dark";
                        }
                    }
                    $batch->date_of_expiry_color = $DateOfExpiryStatus ?? 'text-dark';
                }

                if ($batch->is_draft == 1) {
                    $draftBatchCount += 1;
                } else {
                    // $material_total_quantity  += (float) $batch->quantity * (float) $batch->unit_packing_value;
                    // $batch->total_quantity    = Multiplicate($batch->quantity,$batch->unit_packing_value);
                }
                 if ($page_name !== 'DEDUCT_TRACK_OUTLIFE_REPORT') {
                    if ($batch->end_of_batch == 1) {
                        unset($parent->Batches[$batch_key]);
                    }
                }
                if ($page_name != 'REPORT_DISPOSED_ITEMS' && $page_name != "DEDUCT_TRACK_OUTLIFE_REPORT") {
                    if ($batch->quantity == 0) {
                        unset($parent->Batches[$batch_key]);
                    }
                }
                if ($page_name == 'PRINT_BARCODE_LABEL') {
                    if ($batch->is_draft == 1) {
                        unset($parent->Batches[$batch_key]);
                    }
                }
                if ($page_name == 'EXTEND_EXPIRY') {
                    // $batch->iqc_status == 1
                    if ($batch->is_draft == 1 || $batch->date_of_expiry_color == 'text-success' || $batch->date_of_expiry_color == 'text-dark') {
                        unset($parent->Batches[$batch_key]);
                    }
                }
                if ($page_name == 'RECONCILIATION_LIST') {
                    if ($batch->is_draft == 1 ) {
                        unset($parent->Batches[$batch_key]);
                    }
                }
                if ($page_name == 'REPORT_DISPOSED_ITEMS') {
                    if ($batch->quantity != 0) {
                        unset($parent->Batches[$batch_key]);
                    }
                }
                if ($page_name == 'EARLY_DISPOSAL' || $page_name == 'DEDUCT_TRACK_USAGE_REPORT') {
                    if ($batch->is_draft == 1) {
                        unset($parent->Batches[$batch_key]);
                    }
                }
                if ($page_name == 'THRESHOLD_QTY') {
                    if ($batch->is_draft == 1 ||  $batch->date_of_expiry_color == 'text-dark') {
                        unset($parent->Batches[$batch_key]);
                    }
                }
                if ($page_name == 'DEDUCT_TRACK_OUTLIFE_REPORT') {
                    if ($batch->is_draft == 1 || $batch->withdrawal_type != 'DEDUCT_TRACK_OUTLIFE') {
                        // Log::info($batch->RepackOutlife);
                        unset($parent->Batches[$batch_key]);
                    }
                }
            }
            // $parent['material_total_quantity'] = $material_total_quantity;
            // $parent['material_quantity']       = $material_total_quantity != 0 ? ($material_total_quantity / $parent['unit_packing_value']) : 0;
            $parent['totalUnitPackValue']      = $UnitPackingCount;
            $parent['hideParentRow']           = $parent->Batches->count() == $draftBatchCount ?  1 : 0;
            $parent['hideParentRowReadStatus'] = $readCount == 0 ? 1 : 0;
            $parent['draftBatchCount']         = $draftBatchCount;
            $parent['material_quantity_color'] = generateQtyColor($parent); 
            if ($parent['material_quantity_color'] == 'text-success') {
                MaterialProducts::find($parent->id)->update([
                    "is_read" => 0
                ]);
            }
            if ($page_name == 'THRESHOLD_QTY') {
                if ($parent['material_quantity_color'] == 'text-success') {
                    unset($parent[$key]);
                }
            }
        }
        $access_material_product = $material_product;

        foreach ($access_material_product as $material_index => $material) {
            foreach ($material->Batches as $batch_index => $batch) {
                $batch->permission = 'NONE';
                if(hasAdmin()) {
                    $batch->permission = 'READ_AND_WRITE';
                } else {
                    $access     = json_decode($batch->access);
                    if (isset($access)) {
                        if (in_array(auth_user()->id, $access) == false) {
                            unset($access_material_product[$material_index]->Batches[$batch_index]);
                        }
                    }
                    if (count($batch->BatchOwners)) { 
                        if (in_array(auth_user()->id, Arr::pluck($batch->BatchOwners->toArray(), 'user_id'))) {
                            $batch->permission = 'READ_AND_WRITE';
                        } else {
                            $batch->permission = 'READ_ONLY';
                        }
                    }
                } 
                if($batch->permission == 'READ_ONLY' && !hasAdmin() && $page_name == 'THRESHOLD_QTY') {
                    unset($access_material_product[$material_index]->Batches[$batch_index]); 
                }
                if($page_name === 'NEAR_EXPIRY_EXPIRED' && !hasAdmin()){
                    if (!in_array(auth_user()->id, Arr::pluck($batch->BatchOwners->toArray(), 'user_id'))) { 
                        unset($access_material_product[$material_index]->Batches[$batch_index]); 
                    }
                }
            }
            if (count($material->Batches) == 0) {
                unset($access_material_product[$material_index]);
            } else {
                $material->first_batch_id = array_values($material->Batches->toArray())[0]['id'];
            }
            if ($page_name == 'THRESHOLD_QTY') {
                if ($material->material_quantity_color == 'text-success' || $material->material_quantity_color == 'text-dark' || $material->is_draft == 1) {
                    unset($access_material_product[$material_index]);
                }
            }
        }

        $collection = Arr::flatten($access_material_product);
        if(!is_null($config)) {
            if($config['response'] == 'JSON') {
                return collect($collection);
            }
        }
        $items   = collect($collection);
        $perPage = config('app.paginate');
        $page    = null;
        $page    = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items   = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path'     => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => "page",
        ]);
    }
}

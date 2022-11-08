<?php

use App\Models\Batches;
use App\Models\BatchTracker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

if(! function_exists('category_type')) {
    function category_type() {
        return session()->get('category_type');
    }
}

if(! function_exists('entry_id')) {
    function entry_id() {
        return session()->get('material_product_id');
    }
}
if(! function_exists('material_product')) {
    function material_product() {
        return session()->get('material_product_id');
    }
} 
if(! function_exists('batch_id')) {
    function batch_id() {
        return session()->get('batch_id');
    }
}
if(! function_exists('wizard_mode')) {
    function wizard_mode() {
        return session()->get('wizard_mode');
    }
}
if(! function_exists('forgot_session')) {
    function forgot_session() {
        return session()->forget([
            'wizard_mode',
            'batch_id',
            'material_product_id',
            'form-one',
            'form-two',
            'form-three',
            'form-four',
            'category_type',
            'edit_mode',
        ]);
    }
}
if(! function_exists('is_select')) {
    function is_select() {

        if(wizard_mode() == 'create') {
            $status  = 'selected';
        }
  
        return $status ?? null;
    }
}
if(! function_exists('is_parent')) {
    function is_parent() {
        return  session()->get('edit_mode') == 'parent' ? 1 : '';
    }
}
if(! function_exists('is_disable')) {
    function is_disable($category_type) {
        $wizard_mode = wizard_mode();
        $edit_mode   = session()->get('edit_mode');
        
        if(wizard_mode() != 'edit') {
            return "is_disable.{$wizard_mode}.{$category_type}." ;
        } else {
            return "is_disable.{$wizard_mode}.{$edit_mode}.{$category_type}.";
        }
    }
}
if(! function_exists('completed_tab')) {
    function completed_tab($type) {
        if(session()->get($type)  ==  'completed') {
            return route('create.material-product',['type'=>$type]);
        } 
        else {
            return "#";
        }
    }
}
if(! function_exists('auth_user')) {
    function auth_user() {
        return Sentinel::getUser();
    }
}
if(! function_exists('auth_user_role')) {
    function auth_user_role() {
        return Sentinel::getUser()->roles[0];
    }
}
if(! function_exists('storageGet')) {
    function storageGet($src) {
        if (Storage::exists($src)) { 
            $file = asset(str_replace('public', 'public/storage/',$src)) ;
        } else {
            $file =  $src ;
        }
        return $file;
    }
}
if(! function_exists('is_reset')) {
    function is_reset($column, $value, $category_type) {
        $wizard_mode    = wizard_mode();
        if($wizard_mode == 'duplicate') {
            return $value;
        }
        $reset_status   = config("is_disable.{$wizard_mode}.{$category_type}.{$column}.reset");
        if($reset_status == true || $reset_status == 1) {
            if(session()->get('is_skip_duplicate') === null) {
                return null;
            } else {
                return $value;
            }
        } else {
            return $value;
        }
        // if($reset_status != null) {
        //     if(session()->get('is_skip_duplicate') === null) {
        //         if($reset_status == true || $reset_status == 1) {
        //             Log::info($reset_status);
        //             return null ;
        //         } else {
        //             Log::info($reset_status);
        //             return $value;
        //         }
        //     } else {
        //         return $value;
        //     }
        // } else {
        //     return $value;
        // }
    }
}

if(! function_exists('checkIsMaterialColumn')) {
    function checkIsMaterialColumn($column) {
        $data =  [ 
            'category_selection',
            'item_description',
            'unit_of_measure',
            'unit_packing_value',
            'alert_threshold_qty_upper_limit',
            'alert_threshold_qty_lower_limit',
            'alert_before_expiry',
        ];
        return in_array($column, $data) == true ? 1 : 0 ;
    }
}
if(! function_exists('checkIsBatchesColumn')) {
    function checkIsBatchesColumn($column) {
        $data =  [
            'is_draft',
            'barcode_number',
            'material_product_id',
            'brand',
            'supplier',
            'packing_size',
            'quantity',
            'batch',
            'serial',
            'po_number',
            'statutory_body',
            'euc_material',
            'require_bulk_volume_tracking',
            'require_outlife_tracking',
            'outlife',
            'storage_area',
            'housing_type',
            'housing',
            'owner_one',
            'owner_two',
            'department',
            'access',
            'date_in',
            'date_of_expiry',
            'coc_coa_mill_cert',
            'coc_coa_mill_cert_status',
            'iqc_status',
            'iqc_result',
            'sds',
            'cas',
            'fm_1202',
            'project_name',
            'material_product_type',
            'date_of_manufacture',
            'date_of_shipment',
            'cost_per_unit',
            'remarks',
            'extended_expiry',
            'extended_qc_status',
            'extended_qc_result',
            'disposal_certificate',
            'used_for_td_expt_only',
            'actions',
            'repack_size',
            'barcode_number',
            'iqc_result_status'
        ];
        return in_array($column, $data) == true ? 1 : 0 ;
    }
}
if(! function_exists('checkIsBatchDateColumn')) {
    function checkIsBatchDateColumn($column) {
        $data =  [
            "date_in",
            "date_of_expiry",
            "date_of_manufacture",
            "date_of_shipment"
        ];
        return in_array($column, $data) == true ? 1 : 0 ;
    }
}
 
if(! function_exists('generateBarcode')) {
    function generateBarcode($type) { 
        $category_code  = $type === 'material' ? 1 : 2 ;
        do {
            $barcode_number = random_int(10000000000, 99999999999);
        } while (Batches::where("barcode_number", "=", $category_code.$barcode_number)->first());
        return $category_code.$barcode_number;
    }
}

if(! function_exists('storeFiles')) {
    function storeFiles($fileName) { 
        $file               =   request()->file($fileName);
        $OriginalName       =   $file->getClientOriginalName();
        $OriginalExtension  =   $file->getClientOriginalExtension();
        $baseName           =   basename($OriginalName, '.'.$OriginalExtension);
        $newFileName        =   $baseName.'_'.time().'.'.$OriginalExtension;
        return $file->storeAs('public/files/'.$fileName , $newFileName );
    }
} 

if(! function_exists('no_data_found')) {
    function no_data_found() {
        return '
            <div class="my-5 text-center lead">
                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="150" />
                <div class="text-secondary mt-3">
                   Oops ! there is no data.
                </div>
            </div>
        ';
    }
}

if(! function_exists('strExcelDate')) {
    function strExcelDate($excel_date) {  
        if($excel_date == 'NIL' || $excel_date == 'nill' ||  $excel_date == 'Nill' ||  $excel_date == 'nil' ||  $excel_date == 'Nil' ||  $excel_date == '' ) {
            return  null ;
        }
        $excel_date = (int) $excel_date;
        $unix_date  = ($excel_date - 25569) * 86400;
        $excel_date = 25569 + ($unix_date / 86400);
        $unix_date  = ($excel_date - 25569) * 86400;
        return gmdate("Y-m-d", $unix_date); //2023-12-16
    }
}

if(! function_exists('dateDifferStr')) {
    function dateDifferStr($dt1,$dt2) { 
 
        $updated_outlife_days      = $dt1->diff($dt2)->format('%a');
        $updated_outlife_hours     = $dt1->diff($dt2)->format('%h');
        $updated_outlife_minutes   = $dt1->diff($dt2)->format('%i');
        $updated_outlife_inSeconds = $dt1->diff($dt2)->format('%s');

        $days    = $updated_outlife_days != 0  ? $updated_outlife_days." days," : ' ' ;
        $hours   = $updated_outlife_hours != 0  ? $updated_outlife_hours." hours," : ' ' ;
        $minutes = $updated_outlife_minutes != 0  ? $updated_outlife_minutes." minutes," : ' ' ;
        $seconds = $updated_outlife_inSeconds != 0  ? $updated_outlife_inSeconds." seconds," : ' ' ;

        return $days.$hours.$minutes.$seconds;
    }
}

if(!function_exists('BatchRestore')) {
    function BatchRestore($id)
    {
        $result  =   BatchTracker::where('to_batch_id', $id)->first() ;

        if(!is_null($result)) {
            $fromBatch  = Batches::find($result->from_batch_id);
            if(!is_null($fromBatch)){
                if($result->action_type == 'REPACK_OUTLIFE') { 
                    $fromBatch->quantity       = $result->quantity;
                    $fromBatch->total_quantity = $result->total_quantity;
                }
                $fromBatch->save();
                BatchTracker::where('to_batch_id', $result->to_batch_id)->first()->delete();
            }
        }
        return true;
    }
}
if(!function_exists('groupBy')) {
    function groupBy($key,$data)
    {
        $result = array(); 
        foreach($data as $val) {
            $name = $val[1];
            if(array_key_exists($key, $val)){ 
                $result[$val[$key]][] = $name;
            }else{
                $result[""][] = $name;
            } 
        }
        return $result;
    }
}
if(!function_exists('format_text')) {
    function format_text($text)
    {
        return ucfirst(str_replace(['.','_','-'],' ',$text));
    }
}
if(!function_exists('format_route')) {
    function format_route($text)
    {
        return str_replace(['.','-'],'_',$text);
    }
}

if(!function_exists('getRoutes')) {
    function getRoutes() {
        $routeCollection = Route::getRoutes();
        $routeList       = (array) [];

        foreach ($routeCollection as $value) {
            $prefix = $value->getAction()['prefix'];
            $name   = $value->getAction()['as'] ?? '';
            if($prefix != '_ignition' && $prefix != 'sanctum' && $prefix != 'api' && $prefix != '' && $prefix != '/' && $name != '') {
                $routeList[] =  [
                    0 => str_replace('/','',$prefix),
                    1 => [
                        format_route($name) => false
                    ]
                ];
            }
        } 
        $groupBy = groupBy(0, $routeList);
 
        $menu_list = [];
        foreach($groupBy as $key => $menu) {
            $menu_array = [];
            foreach($menu as $menu_value) {
                
                $menu_array[key($menu_value)] = [
                    'name'   => key($menu_value),
                    'slug'   => page_format(key($menu_value)),
                    'status' => $menu_value[key($menu_value)]
                ];
            }
            
            $menu_list[$key] = $menu_array;
        }
        // dd($menu_list);
        return $menu_list;
    }
    if(!function_exists('page_format')) {
        function page_format($menu_value) {
            $view = [
                'user_index',
                'master_item_description',
                'help_menu_index',
                'pictogram_index',
                'role_index',
                'dashboard',
                'reconciliation',
                'list_material_products',
                'withdrawal_index',
                'extend_expiry',
                'disposal',
                'reports'
            ];
            $create = [
                'user_store',
                'master_store_category',
                'help_menu_create',
                'pictogram_create',
                'role_create',
                'create_material_product'
            ];
            $edit = [
                'user_edit',
                'master_edit_category',
                'help_menu_edit',
                'pictogram_edit',
                'role_edit',
                'edit_or_duplicate_material_product'
            ];
            $delete = [
                'user_delete',
                'master_delete_category',
                'help_menu_delete',
                'pictogram_delete',
                'role_delete',
                'reconciliation_destroy',
            ];
            if(in_array($menu_value,$view)) {
                return 'view';
            } elseif(in_array($menu_value,$edit)) {
                return 'edit';
            } elseif(in_array($menu_value,$create)) {
                return 'create';
            }elseif(in_array($menu_value,$delete)) {
                return 'delete';
            }elseif($menu_value == 'view_reconciliation') {
                return 'listing view';
            }elseif($menu_value == 'reconciliation_download') {
                return 'download';
            }elseif($menu_value == 'reconciliation_store') {
                return 'Import Reconciliate';
            }elseif($menu_value == 'reconciliation_update') {
                return 'Manual Reconciliate';
            }elseif($menu_value == 'delete_material_products') {
                return 'Delete Parent';
            }elseif($menu_value == 'delete_material_products_batch') {
                return 'Delete Batch';
            }elseif($menu_value == 'transfer_batch') {
                return 'transfer';
            }elseif($menu_value == 'repack_batch') {
                return 'repack / transfer';
            }elseif($menu_value == 'repack_outlife') {
                return 'repack / outlife';
            }elseif($menu_value == 'barcode_listing') {
                return 'listing view';
            }elseif($menu_value == 'show_barcode') {
                return 'preview';
            }elseif($menu_value == 'print_barcode') {
                return 'print';
            } elseif($menu_value == 'update_extend_expiry') {
                return 'extend';
            }elseif($menu_value == 'update_disposal') {
                return 'dispose';
            }elseif($menu_value == 'reports_utilisation_cart') {
                return 'utilization cart';
            }elseif($menu_value == 'reports_export_cart') {
                return 'export cart';
            }elseif($menu_value == 'reports_history') {
                return 'history';
            } 
            return  $menu_value;
        }
    }
}
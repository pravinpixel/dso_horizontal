<?php

use App\Models\Batches;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
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
            return $excel_date ;
        }
        $excel_date = (int) $excel_date;
        $unix_date  = ($excel_date - 25569) * 86400;
        $excel_date = 25569 + ($unix_date / 86400);
        $unix_date  = ($excel_date - 25569) * 86400;
        return gmdate("Y-m-d", $unix_date);
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
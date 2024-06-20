<?php
include('permission.php');

use App\Models\Batches;
use App\Models\BatchFiles;
use App\Models\BatchTracker;
use App\Models\DisposedItems;
use App\Models\Masters\Departments;
use App\Models\Masters\HouseTypes;
use App\Models\Masters\MasterCategories;
use App\Models\Masters\PackingSizeData;
use App\Models\Masters\StatutoryBody;
use App\Models\Masters\StorageRoom;
use App\Models\materialProductHistory;
use App\Models\MaterialProducts;
use App\Models\SecurityReport;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Str;

if (!function_exists('category_type')) {
    function category_type()
    {
        return session()->get('category_type');
    }
}

if (!function_exists('entry_id')) {
    function entry_id()
    {
        return session()->get('material_product_id');
    }
}
if (!function_exists('material_product')) {
    function material_product()
    {
        return session()->get('material_product_id');
    }
}
if (!function_exists('batch_id')) {
    function batch_id()
    {
        return session()->get('batch_id');
    }
}
if (!function_exists('wizard_mode')) {
    function wizard_mode()
    {
        return session()->get('wizard_mode');
    }
}
if (!function_exists('forgot_session')) {
    function forgot_session()
    {
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
if (!function_exists('is_select')) {
    function is_select()
    {

        if (wizard_mode() == 'create') {
            $status  = 'selected';
        }

        return $status ?? null;
    }
}
if (!function_exists('is_parent')) {
    function is_parent()
    {
        return  session()->get('edit_mode') == 'parent' ? 1 : '';
    }
}
if (!function_exists('is_disable')) {
    function is_disable($category_type)
    {
        $wizard_mode = wizard_mode();
        $edit_mode   = session()->get('edit_mode');

        if (wizard_mode() != 'edit') {
            return "is_disable.{$wizard_mode}.{$category_type}.";
        } else {
            return "is_disable.{$wizard_mode}.{$edit_mode}.{$category_type}.";
        }
    }
}
if (!function_exists('completed_tab')) {
    function completed_tab($type)
    {
        if (session()->get($type)  ==  'completed') {
            return route('create.material-product', ['type' => $type]);
        } else {
            return "#";
        }
    }
}
if (!function_exists('auth_user')) {
    function auth_user()
    {
        return Sentinel::getUser();
    }
}
if (!function_exists('auth_user_role')) {
    function auth_user_role()
    {
        return Sentinel::getUser()->roles[0];
    }
}
if (!function_exists('storageGet')) {
    function storageGet($src)
    {
        if (Storage::exists($src)) {
            http://192.168.1.100/dso-inventory/storage/app/public/files/pictograms/HIp0DLOFjfICspdTyj4Dwj1JMTH1ezsDcuhgQkuP.jpg
            $file = asset(str_replace('public', 'storage/app/public/', $src));
        } else {
            $file =  $src;
        }
        return $file;
    }
}
if (!function_exists('is_reset')) {
    function is_reset($column, $value, $category_type)
    {
        $wizard_mode    = wizard_mode();
        if ($wizard_mode == 'duplicate') {
            return $value;
        }
        $reset_status   = config("is_disable.{$wizard_mode}.{$category_type}.{$column}.reset");
        if ($reset_status == true || $reset_status == 1) {
            if (session()->get('is_skip_duplicate') === null) {
                return null;
            } else {
                return $value;
            }
        } else {
            return $value;
        }
    }
}

if (!function_exists('checkIsMaterialColumn')) {
    function checkIsMaterialColumn($column)
    {
        $data =  [
            'category_selection',
            'item_description',
            'item_description',
            'unit_of_measure',
             //'unit_packing_value',
            'alert_threshold_qty_upper_limit',
            'alert_threshold_qty_lower_limit',
            'alert_before_expiry',
        ];
        return in_array($column, $data) == true ? 1 : 0;
    }
}
if (!function_exists('checkIsBatchesColumn')) {
    function checkIsBatchesColumn($column)
    {
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
        return in_array($column, $data) == true ? 1 : 0;
    }
}
if (!function_exists('checkIsBatchDateColumn')) {
    function checkIsBatchDateColumn($column)
    {
        $data =  [
            "date_in",
            "date_of_expiry",
            "disposed_after",
            "date_of_manufacture",
            "date_of_shipment"
        ];
        return in_array($column, $data) == true ? 1 : 0;
    }
}

if (!function_exists('generateBarcode')) {
    function generateBarcode($type)
    {
        $category_code  = $type === 'material' ? 1 : 2;
        do {
            $barcode_number = random_int(10000000000, 99999999999);
        } while (Batches::where("barcode_number", "=", $category_code . $barcode_number)->first());
        return $category_code . $barcode_number;
    }
}

if (!function_exists('storeFiles')) {
    function storeFiles($fileName)
    {
        $file               =   request()->file($fileName);
        $OriginalName       =   $file->getClientOriginalName();
        $OriginalExtension  =   $file->getClientOriginalExtension();
        $baseName           =   basename($OriginalName, '.' . $OriginalExtension);
        $newFileName        =   $baseName . '_' . time() . '.' . $OriginalExtension;
        return $file->storeAs('public/files/' . $fileName, $newFileName);
    }
}

if (!function_exists('no_data_found')) {
    function no_data_found()
    {
        return '
            <div class="my-5 text-center lead">
                <img src="' . asset('public/asset/images/no-data.png') . '" width="150" />
                <div class="text-secondary mt-3">
                   Oops ! there is no data.
                </div>
            </div>
        ';
    }
}

if (!function_exists('strExcelDate')) {
    function strExcelDate($excel_date)
    {
        if ($excel_date == 'NIL' || $excel_date == 'nill' ||  $excel_date == 'Nill' ||  $excel_date == 'nil' ||  $excel_date == 'Nil' ||  $excel_date == '') {
            return  null;
        }
        return Carbon::parse(str_replace('/', '-', $excel_date))->format('Y-m-d');
    }
}

if (!function_exists('dateDifferStr')) {
    function dateDifferStr($dt1, $dt2)
    {

        $updated_outlife_days      = $dt1->diff($dt2)->format('%a');
        $updated_outlife_hours     = $dt1->diff($dt2)->format('%h');
        $updated_outlife_minutes   = $dt1->diff($dt2)->format('%i');
        $updated_outlife_inSeconds = $dt1->diff($dt2)->format('%s');

        $days    = $updated_outlife_days != 0  ? $updated_outlife_days . " days," : ' ';
        $hours   = $updated_outlife_hours != 0  ? $updated_outlife_hours . " hours," : ' ';
        $minutes = $updated_outlife_minutes != 0  ? $updated_outlife_minutes . " minutes," : ' ';
        $seconds = $updated_outlife_inSeconds != 0  ? $updated_outlife_inSeconds . " seconds," : ' ';

        return $days . $hours . $minutes . $seconds;
    }
}

if (!function_exists('BatchRestore')) {
    function BatchRestore($id)
    {
        $result  =   BatchTracker::where('to_batch_id', $id)->first();

        if (!is_null($result)) {
            $fromBatch  = Batches::find($result->from_batch_id);
            if (!is_null($fromBatch)) {
                if ($result->action_type == 'REPACK_OUTLIFE') {
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
if (!function_exists('groupBy')) {
    function groupBy($key, $data)
    {
        $result = array();
        foreach ($data as $val) {
            $name = $val[1];
            if (array_key_exists($key, $val)) {
                $result[$val[$key]][] = $name;
            } else {
                $result[""][] = $name;
            }
        }
        return $result;
    }
}
if (!function_exists('format_text')) {
    function format_text($text)
    {
        return ucfirst(str_replace(['.', '_', '-'], ' ', $text));
    }
}
if (!function_exists('format_route')) {
    function format_route($text)
    {
        return str_replace(['.', '-'], '_', $text);
    }
}

if (!function_exists('getRoutes')) {
    function getRoutes()
    {
        $routeCollection = Route::getRoutes();
        $routeList       = (array) [];
        foreach ($routeCollection as $value) {
            $prefix = $value->getAction()['prefix'];
            $name   = $value->getAction()['as'] ?? '';
            if ($prefix != '_ignition' && $prefix != 'sanctum' && $prefix != 'api' && $prefix != '' && $prefix != '/' && $name != '' && $prefix !== '_debugbar' && $prefix !== '/jobs') {
                $routeList[] =  [
                    0 => str_replace('/', '', $prefix),
                    1 => [
                        format_route($name) => false
                    ]
                ];
            }
        }
        $groupBy = groupBy(0, $routeList);

        $menu_list = [];
        foreach ($groupBy as $key => $menu) {
            $menu_array = [];
            foreach ($menu as $menu_value) {

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
    if (!function_exists('page_format')) {
        function page_format($menu_value)
        {
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
                'reports',
                'table_order_index',
            ];
            $create = [
                'user_store',
                'master_store_category',
                'help_menu_create',
                'pictogram_create',
                'role_create',
                'create_material_product',
                'table_order_store'
            ];
            $edit = [
                'user_edit',
                'master_edit_category',
                'help_menu_edit',
                'pictogram_edit',
                'role_edit',
                'edit_or_duplicate_material_product',
                'master_update_category'
            ];
            $delete = [
                'user_delete',
                'master_delete_category',
                'help_menu_delete',
                'pictogram_delete',
                'role_delete',
                'reconciliation_destroy',
            ];
            if (in_array($menu_value, $view)) {
                $menu_value = 'view';
            } elseif (in_array($menu_value, $edit)) {
                $menu_value = 'edit';
            } elseif (in_array($menu_value, $create)) {
                $menu_value = 'create';
            } elseif (in_array($menu_value, $delete)) {
                $menu_value = 'delete';
            } elseif ($menu_value == 'view_reconciliation') {
                $menu_value = 'listing view';
            } elseif ($menu_value == 'reconciliation_download') {
                $menu_value = 'download';
            } elseif ($menu_value == 'reconciliation_store') {
                $menu_value = 'Import Reconciliate';
            } elseif ($menu_value == 'reconciliation_update') {
                $menu_value = 'Manual Reconciliate';
            } elseif ($menu_value == 'delete_material_products') {
                $menu_value = 'Delete parent';
            } elseif ($menu_value == 'delete_material_products_batch') {
                $menu_value = 'Delete batch';
            } elseif ($menu_value == 'transfer_batch') {
                $menu_value = 'Transfer';
            } elseif ($menu_value == 'repack_batch') {
                $menu_value = 'Repack / transfer';
            } elseif ($menu_value == 'repack_outlife') {
                $menu_value = 'Repack / outlife';
            } elseif ($menu_value == 'barcode_listing') {
                $menu_value = 'Listing view';
            } elseif ($menu_value == 'show_barcode') {
                $menu_value = 'Preview';
            } elseif ($menu_value == 'print_barcode') {
                $menu_value = 'Print';
            } elseif ($menu_value == 'update_extend_expiry') {
                $menu_value = 'Extend';
            } elseif ($menu_value == 'update_disposal') {
                $menu_value = 'Dispose';
            } elseif ($menu_value == 'reports_utilisation_cart') {
                $menu_value = 'Utilization cart';
            } elseif ($menu_value == 'reports_export_cart') {
                $menu_value = 'Export cart';
            } elseif ($menu_value == 'reports_history') {
                $menu_value = 'History';
            } elseif ($menu_value == 'reports_disposed_items') {
                $menu_value = 'Disposed items';
            } elseif ($menu_value == 'reports_expired_material') {
                $menu_value = 'Expired material';
            } elseif ($menu_value == 'reports_security') {
                $menu_value = 'Security history';
            } elseif ($menu_value == 'reports_export_security') {
                $menu_value = 'Export / Security history';
            } elseif ($menu_value == 'reports_deduct_track_outlife') {
                $menu_value = 'Deduct track outlife';
            } elseif ($menu_value == 'reports_deduct_track_outlife_download') {
                $menu_value = 'Export / Deduct track outlife';
            } elseif ($menu_value == 'reports_deduct_track_usage') {
                $menu_value = 'Deduct track usage';
            } elseif ($menu_value == 'reports_deduct_track_usage_download') {
                $menu_value = 'Export / Deduct track usage';
            } elseif ($menu_value == 'reports_material_in_house_pdt_history') {
                $menu_value = 'Products history';
            } elseif ($menu_value == 'reports_material_in_house_pdt_history_download') {
                $menu_value = 'Export / Products history';
            } elseif ($menu_value == 'reports_utilization_cart') {
                $menu_value = 'Utilization cart';
            } elseif ($menu_value == 'near_expiry_expired') {
                $menu_value = 'Near expiry / Expired / Failed IQC';
            }

            return  $menu_value;
        }
    }
    if (!function_exists('getExpiredMaterials')) {
        function getExpiredMaterials()
        {
            $data             = Batches::with(['BatchMaterialProduct', 'StorageArea', 'HousingType'])->where('is_draft', 0)->latest()->get();
            $expired_material = [];
            foreach ($data as $key => $row) {
                $now            = Carbon::now();
                $date_of_expiry = Carbon::parse($row->date_of_expiry);
                if ($now >= $date_of_expiry) {
                    $expired_material[] = [
                        "category_selection"    => MaterialProducts::find($row->material_product_id)->category_selection,
                        "item_description"      => MaterialProducts::find($row->material_product_id)->item_description,
                        "batch_serial"          => $row->batch . " / " . $row->serial,
                        "unit_packing_value"    => $row->unit_packing_value,
                        "quantity"              => $row->quantity,
                        "storage_area"          => $row->StorageArea->name,
                        "housing"               => $row->housing,
                        "date_of_expiry"        => $row->date_of_expiry,
                        "used_for_td_expt_only" => $row->used_for_td_expt_only,
                        "department"            => $row->Department->name,
                        "department_id"         => $row->department,
                        "owners"                => $row->owner_one . " / " . $row->owner_two,
                    ];
                }
            }
            return $expired_material;
        }
    }
    if (!function_exists('securityLog')) {
        function securityLog($action_name)
        {
            SecurityReport::create([
                'user_name' => auth_user()->alias_name,
                'user_id'   => auth_user()->id,
                'action'    => $action_name
            ]);
            return true;
        }
    }
    if (!function_exists('getUserById')) {
        function getUserById($id)
        {
            return User::find($id);
        }
    }
    if (!function_exists('SetDateFormat')) {
        function SetDateFormat($date)
        {
            if (is_null($date) || empty($date)) {
                return $date;
            }
            try {
                return Carbon::parse(str_replace('/', '-', $date))->format('d/m/Y');
            } catch (\Throwable $th) {
                return $date;
            }
        }
    }
    if (!function_exists('SetDateFormatWithHour')) {
        function SetDateFormatWithHour($date)
        {
        return Carbon::parse()->format('d/m/Y H:i'); 
        
        }
    }
    if (!function_exists('SetDateFormatWithHours')) {
        function SetDateFormatWithHours($date)
        {
        return Carbon::parse($date)->format('d/m/Y H:i'); 
        
        }
    }
    if (!function_exists('getBarcodeImage')) {
        function getBarcodeImage($number)
        {
            $generatorPNG = new BarcodeGeneratorPNG;
            return '<img src="data:image/png;base64,' . base64_encode($generatorPNG->getBarcode($number, $generatorPNG::TYPE_CODE_128)) . '">';
        }
    }
    if (!function_exists('getBarcode')) {
        function getBarcode($number)
        {
            $generator = new  BarcodeGeneratorHTML();
            return $generator->getBarcode($number, $generator::TYPE_CODE_128);
        }
    }
    if (!function_exists('TrackDisposedBatches')) {
        function TrackDisposedBatches($batch, $AfterQuantity)
        {
            DisposedItems::create([
                "TransactionDate"  => Carbon::now()->format('d/m/Y'),
                "TransactionTime"  => Carbon::now()->format('h:i:s A'),
                "TransactionBy"    => auth_user()->alias_name,
                "ItemDescription"  => $batch->BatchMaterialProduct->item_description,
                "BatchSerial"      => $batch->batch . " / " . $batch->serial,
                "UnitPackingValue" => $batch->unit_packing_value,
                "BeforeQuantity"   => $batch->quantity + $AfterQuantity,
                "DisposedQuantity" => $AfterQuantity,
                "AfterQuantity"    => $batch->quantity,
                "user_id"          => auth_user()->id
            ]);
            return true;
        }
    }
    if (!function_exists('MaterialProductHistory')) {
        function MaterialProductHistory($Batch, $ActionTaken, $updated_outlife = null)
        {
           if($ActionTaken=='Material Deleted'){
            $batch       = MaterialProducts::find($Batch['id']);
           }else{
            $batch       = Batches::with('BatchOwners')->find($Batch['id']);
            $BatchOwners = '';
            if (count($batch->BatchOwners) > 0) {
                foreach ($batch->BatchOwners as $key => $owner) {
                    if ($owner->alias_name ?? false) {
                        $BatchOwners .= $owner->alias_name . ' , ';
                    }
                }
            }
           }
            
            if ($ActionTaken == 'Repack_Outlife_Draw_IN') {
                $DrawStatus = 'Draw IN';
            }
            
            if ($ActionTaken == 'Repack_Outlife_Draw_OUT') {
                $DrawStatus = 'Draw OUT';
            }
            if ($ActionTaken == 'Child_Batch_Created') {
                $DrawStatus = 'Child Batch Created';
            }
            if ($ActionTaken == 'AUTO_DRAW_IN') {
                $DrawStatus = 'AUTO DRAW IN';
            }
             if ($ActionTaken == 'End_Of_Batch') {
                $DrawStatus = 'End of Batch';
            }
            if ($ActionTaken == 'Repack_Outlife_Draw_OUT' || $ActionTaken == 'Repack_Outlife_Draw_IN') {
                $ActionTaken = 'Repack Outlife';
            }
            if ($ActionTaken == 'BEFORE_DEDUCT_TRACK_OUTLIFE') {
                $ActionTaken = 'Before With Out Draw In/Out';
            }
            if ($ActionTaken == 'AFTER_DEDUCT_TRACK_OUTLIFE') {
                $ActionTaken = 'With Out Draw In/Out';
            }
            if ($ActionTaken == 'USED_FOR_TD_EXPT') {
                $ActionTaken = 'Used for TD/Expt Project';
            }
            if ($ActionTaken == 'TO_DISPOSE') {
                $ActionTaken = 'For Disposal';
            }
            materialProductHistory::updateOrCreate([
                'batch_id'                 => $Batch['id'],
                'barcode_number'           => $Batch['barcode_number']?? null,
                'CategorySelection'        => $batch['BatchMaterialProduct']['category_selection']?? $batch['category_selection'] ,
                'ItemDescription'          => $batch['BatchMaterialProduct']['item_description']?? $batch['item_description'],
                'Brand'                    => $Batch['brand']??null,
                'BatchSerial'              => $Batch['batch']. " / " . $Batch['serial'],
                'TransactionBy'            => auth_user()->alias_name ?? "AUTO DRAW",
                'Module'                   => session()->get('page_name'),
                'ActionTaken'              => $ActionTaken,
                'UnitPackingValue'         => $Batch['unit_packing_value']??null,
                'Quantity'                 => $Batch['quantity']??null,
                'StorageArea'              => $batch['StorageArea']['name'] ?? '',
                'Housing'                  => $Batch['housing']??null,
                'Owners'                   => $BatchOwners??null,
                'Remarks'                  => $Batch['remarks'] ?? "-",
                'DrawStatus'               => $DrawStatus ?? null,
                'RemainingOutlifeOfParent' => $updated_outlife??null
            ]);
            return true;
        }
    }
    if (!function_exists('Multiplicate')) {
        function Multiplicate($one, $two)
        {
            $number_one = $one;
            $number_two = $two;
            return round($number_one * $number_two, 2);
        }
    }
    if (!function_exists('generateFileName')) {
        function generateFileName($name, $extension)
        {
            return str_replace(' ', "_", $name . '_' . Carbon::now()) . '.' . $extension;
        }
    }
    if (!function_exists('dateBetween')) {
        function dateBetween($request)
        {
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date   = Carbon::parse($request->end_date)->endOfDay();
            return [
                $start_date,
                $end_date
            ];
        }
    }
    if (!function_exists('toFixed')) {
        function toFixed($number, $digit)
        {
            return  number_format($number, $digit, '.', '');
        }
    }

    if (!function_exists('ExportDataFormat')) {
        function ExportDataFormat($data)
        {
            $FormatedData = [];
            foreach ($data as $key => $item) {
                if ($item['used_for_td_expt_only'] == 1) {
                    $item['used_for_td_expt_only'] = "Yes";
                } else {
                    $item['used_for_td_expt_only'] = "No";
                }

                $FormatedData[] = $item;
            }
            return $FormatedData;
        }
    }

    if (!function_exists('getMasterData')) {
        function getMasterData($type)
        {
            switch ($type) {
                case 'category_selection':
                    return MasterCategories::all();
                    break;
                case 'statutory_body':
                    return StatutoryBody::all();
                    break;
                case 'unit_packing_size':
                    return PackingSizeData::all();
                    break;
                case 'storage_room':
                    return StorageRoom::all();
                    break;
                case 'house_type':
                    return HouseTypes::all();
                    break;
                case 'departments':
                    return Departments::all();
                    break;
            }
        }
    }

    if (!function_exists('strtoFileExtenion')) {
        function strtoFileExtenion($text)
        {
            return  Str::random(15) . '.' . explode('.', $text)[1];
        }
    }

    if (!function_exists('cloneDocumentFromBatch')) {
        function cloneDocumentFromBatch($from_id, $to_id)
        {
            $from_batch = Batches::with('BatchFiles')->find($from_id);
            $to_batch   = Batches::with('BatchFiles')->find($to_id);

            if (Storage::exists($from_batch->iqc_result)) {
                $iqc_result_new_file =  "public/" . strtoFileExtenion($from_batch->iqc_result);
                Storage::copy($from_batch->iqc_result, $iqc_result_new_file);
                $to_batch->iqc_result =  $iqc_result_new_file;
            }

            if (Storage::exists($from_batch->sds)) {
                $sds_new_file =  "public/" . strtoFileExtenion($from_batch->sds);
                Storage::copy($from_batch->sds, $sds_new_file);
                $to_batch->sds =  $sds_new_file;
            }

            if (Storage::exists($from_batch->extended_qc_result)) {
                $extended_qc_result_new_file =  "public/" . strtoFileExtenion($from_batch->extended_qc_result);
                Storage::copy($from_batch->extended_qc_result, $extended_qc_result_new_file);
                $to_batch->extended_qc_result =  $extended_qc_result_new_file;
            }

            if (Storage::exists($from_batch->disposal_certificate)) {
                $disposal_certificate_new_file =  "public/" . strtoFileExtenion($from_batch->disposal_certificate);
                Storage::copy($from_batch->disposal_certificate, $disposal_certificate_new_file);
                $to_batch->disposal_certificate =  $disposal_certificate_new_file;
            }

            if (count($from_batch->BatchFiles) > 0) {
                foreach ($from_batch->BatchFiles as $file) {
                    if (Storage::exists($file->file_name)) {
                        $file_name =  "public/" . strtoFileExtenion($file->file_name);
                        Storage::copy($file->file_name, $file_name);
                        $to_batch->BatchFiles()->create([
                            'column_name'    => $file->column_name,
                            'original_name'  => $file->file_name,
                            'file_name'      => $file_name,
                            'file_extension' => explode('.', $file_name)[1],
                            'file_path'      => asset('storage/app') . '/' . $file_name,
                        ]);
                    }
                }
            }
            $to_batch->save();

            return true;
        }
    }

    if (!function_exists('is_repack_outlife')) {
        function is_repack_outlife($data)
        {
            $is_null = 0;
            foreach ($data as $key => $item) {
                if (!is_null($item->draw_in_time_stamp) && !is_null($item->draw_out_time_stamp)) {
                    $is_null++;
                }
            }
            return $is_null == 0 ? 0 : 1;
        }
    }

    if (!function_exists('currentOutlifeExpiry')) {
        function currentOutlifeExpiry($outlife_seconds)
        {
            return CarbonImmutable::now()->add($outlife_seconds, 'second')->toDateTimeString();
        }
    }
     if (!function_exists('currentOutlifeDate')) {
        function currentOutlifeDate($outlife_seconds)
        {    
            $days=floor($outlife_seconds / 86400);
            $hours = floor(($outlife_seconds -($days*86400)) / 3600);
            $minutes = floor(($outlife_seconds / 60) % 60);
            $seconds = $outlife_seconds % 60;
            $diffrence='';

            if(isset($hours)){
             $now=\Carbon\Carbon::now();
             $diffrence=$now->addDays($days)->addHours($hours)->addMinutes($minutes)->addSeconds($seconds);
             return $diffrence;
            }
            return $diffrence;
            
        }
    }
     if (!function_exists('SetDateOutlifeDate')) {
        function SetDateOutlifeDate($date,$outlife_seconds)
        {    
            $days=floor($outlife_seconds / 86400);
            $hours = floor(($outlife_seconds -($days*86400)) / 3600);
            $minutes = floor(($outlife_seconds / 60) % 60);
            $seconds = $outlife_seconds % 60;
            $diffrence='';

            if(isset($hours)){
             $now=Carbon::parse($date);
             $diffrence=$now->addDays($days)->addHours($hours)->addMinutes($minutes)->addSeconds($seconds);
             return $diffrence;
            }
            return $diffrence;
            
        }
    }
     if (!function_exists('NowOutlifeDate')) {
        function NowOutlifeDate($outlife_seconds,$date)
        {    
            $days=floor($outlife_seconds / 86400);
            $hours = floor(($outlife_seconds -($days*86400)) / 3600);
            $minutes = floor(($outlife_seconds / 60) % 60);
            $seconds = $outlife_seconds % 60;
            $diffrence='';

            if(isset($hours)){
             $now=Carbon::createFromFormat('Y-m-d H:i:s', $date);
             $diffrence=$now->addDays($days)->addHours($hours)->addMinutes($minutes)->addSeconds($seconds);
            
             return $diffrence;
            }
            return $diffrence;
            
        }
    }

    if (!function_exists('updateParentQuantity')) {
        function updateParentQuantity($id)
        {
            if (is_numeric($id)) {
                $material_product = MaterialProducts::with('NonDraftBatches')->find($id);
                $batches = $material_product->NonDraftBatches;
            } else {
                $material_product = $id;
                $batches          = $id->NonDraftBatches;
            }
            $total_batch_quantity = $batches->sum('total_quantity');
            $material_product->update([
                "material_total_quantity" => $total_batch_quantity,
                "material_quantity"       => ($total_batch_quantity / $material_product->unit_packing_value),
            ]);
            return true;
        }
    }

    if (!function_exists('putBatchFile')) {
        function putBatchFile($config)
        {
            if (Storage::exists($config['file'])) {
                Storage::delete($config['file']);
            }
            $file_name_slug = Str::slug(str_replace($config['file']->getClientOriginalExtension(), '', $config['file']->getClientOriginalName())) . "." . $config['file']->getClientOriginalExtension();
            $prevFiles      = BatchFiles::where("file_name", 'public/' . $file_name_slug)->get();
            if (count($prevFiles)) {
                return false;
            }
            $newFileName    = Storage::putFileAs('public', $config['file'], $file_name_slug);
            BatchFiles::updateOrCreate([
                'batch_id'       => $config['batch_id'],
                'column_name'    => $config['type'],
                'original_name'  => $config['file']->getClientOriginalName(),
                'file_name'      => $newFileName,
                'file_extension' => $config['file']->getClientOriginalExtension(),
                'file_path'      => asset('storage/app') . '/' . $newFileName,
            ]);
            return true;
        }
    }
    if (!function_exists('getBatchFile')) {
        function getBatchFile($files, $type, $removeBtn = null)
        {
            return view('templates.batch-files-ui', compact('files', 'type', 'removeBtn'));
        }
    }
    if (!function_exists('str_rev')) {
        function str_rev($delimiter, $string)
        {
            return implode($delimiter, array_reverse(explode($delimiter, $string)));
        }
    }
    if (!function_exists('permute')) {

        function permute($arr=0, $start = 0, &$result = [], $isArray=[])
        {
            if ($start === count($arr) - 1) {
                $result[] = $isArray ?  $arr : implode(',', $arr);
                return;
            }
            for ($i = $start; $i < count($arr); $i++) {
                [$arr[$start], $arr[$i]] = [$arr[$i], $arr[$start]]; // Swap elements
                permute($arr, $start + 1, $result, $isArray); // Recurse with the next start position
                [$arr[$start], $arr[$i]] = [$arr[$i], $arr[$start]]; // Swap back to original order for next iteration
            }
        }
    }

    if (!function_exists('array_permute')) {
        function array_permute($inputArray, $isArray = true)
        {
            $result = [];
            permute($inputArray, 0, $result, $isArray);
            return $result;
        }
    }
    if (!function_exists('generateQtyColor')) {
        function generateQtyColor($material)
        {
            $quantityColor = 'text-dark';
            if ($material->material_quantity < $material->alert_threshold_qty_lower_limit) {
                $quantityColor = 'text-danger';
            }
            if ($material->material_quantity > $material->alert_threshold_qty_upper_limit && $material->material_quantity > $material->alert_threshold_qty_lower_limit) {
                $quantityColor = 'text-success';
            }
            if ($material->alert_threshold_qty_lower_limit <= $material->material_quantity && $material->material_quantity <= $material->alert_threshold_qty_upper_limit) {
                $quantityColor = 'text-warning';
            }
            if (is_null($material->alert_threshold_qty_upper_limit)) {
                $quantityColor = 'text-dark';
            }
            return $quantityColor;
        }
    }
    if (!function_exists('convertDateFormat')) {
        function convertDateFormat($originalDate, $format)
        {
            $carbonDate = Carbon::createFromFormat('F jS Y, g:i:s a', $originalDate);
            $formattedDate = $carbonDate->format($format);
            return $formattedDate;
        }
    }
    if (!function_exists('sentenceCase')) {
        function sentenceCase($input)
        {
            $sentences = preg_split('/([.?!]+)/', $input, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            $new_sentences = [];

            foreach ($sentences as $key => $sentence) {
                if ($key % 2 == 0) {
                    $new_sentences[] = ucfirst(trim($sentence));
                } else {
                    $new_sentences[] = $sentence;
                }
            }

            return implode('', $new_sentences);
        }
    }

    if (!function_exists('tableColumnFormat')) {
        function tableColumnFormat($text)
        {
            switch ($text) {
                case 'extended_qc_status':
                    $text = 'Extended QC status';
                    break;
                case 'used_for_td_expt_only':
                    $text = 'Used for TD/Expt only';
                    break;
                case 'iqc_status':
                    $text = 'IQC status';
                    break;
                case 'alert_threshold_qty_lower_limit':
                    $text = 'Alert threshold qty (lower limit)';
                    break;
                case 'alert_threshold_qty_upper_limit':
                    $text = 'Alert threshold qty (upper limit)';
                    break;
                case 'cas':
                    $text = 'CAS';
                    break;
                case 'po_number':
                    $text = 'PO #';
                    break;
                case 'euc_material':
                    $text = 'EUC material';
                    break;
                case 'housing':
                    $text = 'Housing #';
                    break;
                default:
                    $text = format_text($text);
                    break;
            }
            return $text;
        }
    }
}

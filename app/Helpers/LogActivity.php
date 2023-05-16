<?php

namespace App\Helpers;

use App\Models\Batches;
use App\Models\BatchTracker;
use App\Models\LogSheet;
use App\Models\MaterialProducts;
use App\Models\SecurityReport;

class LogActivity
{
    static $SecurityReportData;
    public static function log($id, $remarks = null)
    {
        switch (request()->route()->getActionMethod()) {
            case 'batch_destroy':
                $action_type  = 'DELETE';
                $module_name  = 'Batches';
                break;
            case 'destroy':
                $action_type  = 'DELETE';
                $module_name  = 'MaterialProducts';
                break;
            case 'duplicate_batch':
                $action_type  = 'DUPLICATE';
                $module_name  = 'Batches';
                break;
            case 'save_search_history':
                $action_type  = 'CREATE';
                $module_name  = 'SaveMySearch';
                break;
            case 'delete_search_history':
                $action_type  = 'DELETE';
                $module_name  = 'SaveMySearch';
                break; 
            case 'storeWizardForm':
                switch (request()->route()->getName()) {
                    case 'create.material-product':
                        $action_type  = 'CREATE';
                        $module_name  = 'MaterialProducts';
                        break;
                    case 'edit_or_duplicate.material-product':
                        $action_type  = 'UPDATE';
                        $module_name  = 'MaterialProducts';
                        break;
                }
                break;
            case 'transfer':
                $action_type  = 'TRANSFER';
                $module_name  = 'Batches';
                break;
            case 'ReconciliationUpdate':
                $action_type  = 'RECONCILIATION';
                $module_name  = 'Batches';
                break;
            case 'ReconciliationImportUpdate':
                $action_type  = 'RECONCILIATION_FROM_IMPORT_EXCEL';
                $module_name  = 'Batches';
                break;
            case 'import_excel':
                $action_type  = 'IMPORTED_FROM_EXCEL';
                $module_name  = 'MaterialProducts';
                break;
        }
        LogSheet::updateOrCreate([
            'ip'          => request()->ip(),
            'agent'       => request()->header('user-agent'),
            'user_id'     => auth_user()->id,
            'user_name'   => auth_user()->alias_name,
            'module_name' => $module_name,
            'action_type' => $action_type ?? "",
            "module_id"   => $id,
            'remarks'     => $remarks ?? ''
        ]);
    }

    public static function dataLog($old, $new, $remarks = null)
    {
        switch (request()->route()->getActionMethod()) {
            case 'transfer':
                $action_type = 'TRANSFER';
                $module_name = "Batches";
                $remarks     = $new->remarks;
                break;
            case 'repack':
                $action_type = 'REPACK_TRANSFER';
                $module_name = "Batches";
                $remarks     = $new->remarks;
                break;
            case 'store_repack_outlife':
                $action_type = 'REPACK_OUTLIFE';
                $module_name = 'Batches';
                $remarks     = $new->remarks;
                break;
            case 'direct_deduct':
                $action_type = 'DIRECT_DEDUCT';
                $module_name = 'Batches';
                $remarks     = $new->remarks;
                break;
            case 'deduct_track_outlife':
                $action_type = 'DEDUCT_TRACK_OUTLIFE';
                $module_name = 'RepackOutlife';
                $remarks     = $new->remarks;
                break;
            case 'disposal_update':
                $action_type = 'EARLY_DISPOSAL';
                $module_name = 'Batches';
                $remarks     = '-';
                break;
            case 'deduct_track_usage':
                $action_type = 'DEDUCT_TRACK_USAGE';
                $module_name = 'Withdrawal';
                $remarks     = $new->remarks;
                break;
        }
        switch (request()->route()->getName()) {
            case 'update.extend-expiry':
                $action_type = 'EXTEND_EXPIRY';
                $module_name = 'Batches';
                $remarks     = $new->remarks;
                break;
        }
        // dd($new);
        // dd($old);
        // LogSheet::updateOrCreate([
        //     'ip'          => request()->ip(),
        //     'agent'       => request()->header('user-agent'),
        //     'user_id'     => auth_user()->id,
        //     'user_name'   => auth_user()->alias_name,
        //     'module_name' => $module_name,
        //     'action_type' => $action_type,
        //     'old'         => json_encode($old),
        //     'new'         => json_encode($new),
        //     'module_id'   => $old->id ?? '',
        //     'remarks'    =>  $remarks
        // ]);
        // materialProductHistory::create([
        //     'CategorySelection' => $old->BatchMaterialProduct->category_selection,
        //     'ItemDescription'   => $old->BatchMaterialProduct->item_description,
        //     'Brand'             => $old->brand,
        //     'BatchSerial'       => $old->batch." / ".$old->serial,
        //     'TransactionBy'     => auth_user()->alias_name,
        //     'Module'            => session()->get('page_name'),
        //     'ActionTaken'       => $action_type,
        //     'UnitPackingValue'  => $old->unit_packing_value,
        //     'Quantity',
        //     'StorageArea' => $old->StorageArea->name,
        //     'Housing'     => $old->housing,
        //     'Owners'      => $old->BatchOwners,
        //     'Remarks'     => $old->remarks,
        //     'DrawStatus',
        //     'RemainingOutlifeOfParent'
        // ]);
    }

    public static function all()
    {
        return LogSheet::with('User')->latest()->get();
    }

    public static function tracker($data)
    {
        $batch = Batches::find($data['from']);

        return BatchTracker::create([
            "from_batch_id"  => $data['from'],
            "to_batch_id"    => $data['to'],
            "action_type"    => $data['type'],
            "action_by"      => $data['action_by'],
            "quantity"       => $batch->quantity,
            "total_quantity" => $batch->total_quantity
        ]);
    }

    public static function getDisposalItems()
    {
        $logs =  LogSheet::where('action_type', 'EARLY_DISPOSAL')->latest()->get();

        $disposal_items = [];
        foreach ($logs as $key => $log) {
            $batch = json_decode($log->new);
            if ($batch->quantity == 0) {
                $disposal_items[] = [
                    "transaction_date" => $log->created_at->format('d-m-Y'),
                    "transaction_time" => $log->created_at->format('h:i:s A'),
                    "transaction_by"   => $log->user_name,
                    "item_description" => MaterialProducts::find($batch->material_product_id)->item_description,
                    "batch_serial"     => $batch->batch . ' / ' . $batch->serial,
                    "unit_pack_value"  => $batch->unit_packing_value,
                    "quantity"         => (string) $batch->quantity,
                ];
            }
        }
        return  $disposal_items;
    }
    public static function getSecurityReport()
    {
        $SecurityReport = SecurityReport::latest()->get();
        $arr = [];
        foreach ($SecurityReport as $key => $row) {
            $arr[] = [
                "transaction_date" => $row->created_at->format('d-m-Y'),
                "transaction_time" => $row->created_at->format('h:i:s A'),
                "transaction_by"   => $row->user_name,
                "action"           => $row->action,
                "file_path"        => $row->file_path,
                "file_id"          => $row->file_id,
                "type"             => $row->type,
                "created_at"       => $row->created_at->format('d-m-Y h:i:s A')
            ];
        }
        return  $arr;
    }
    public static function where($data = null)
    {
        if (is_null($data)) {
            $data = SecurityReport::latest()->get();
        }
        static::$SecurityReportData = $data;
        return new self;
    }
    public static function dateBetween($request)
    {
        $SecurityReport =  SecurityReport::whereBetween('created_at', dateBetween($request))->latest()->get();
        $arr = [];
        foreach ($SecurityReport as $key => $row) {
            $arr[] = [
                "transaction_date" => $row->created_at->format('d-m-Y'),
                "transaction_time" => $row->created_at->format('h:i:s A'),
                "transaction_by"   => $row->user_name,
                "action"           => $row->action,
                "created_at"       => $row->created_at->format('d-m-Y h:i:s A')
            ];
        }
        self::$SecurityReportData = $arr;
        return self::$SecurityReportData;
    }
}

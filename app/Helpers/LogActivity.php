<?php

namespace App\Helpers;

use App\Models\LogSheet;

class LogActivity
{
    public static function log($id)
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
            case 'import_excel':
                $action_type  = 'IMPORT';
                $module_name  = 'MaterialProducts';
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
        }

        LogSheet::updateOrCreate([
            'ip'          => request()->ip(),
            'agent'       => request()->header('user-agent'),
            'user_id'     => auth_user()->id,
            'user_name'   => auth_user()->alias_name,
            'module_name' => $module_name,
            'action_type' => $action_type ?? "",
            "module_id"   => $id
        ]);
    }

    public static function dataLog($old, $new)
    {
        switch (request()->route()->getActionMethod()) {
            case 'transfer':
                $action_type = 'TRANSFER';
                $module_name = "Batches";
                break;
            case 'repack':
                $action_type = 'REPACK_TRANSFER';
                $module_name = "Batches";
                break;
            case 'store_repack_outlife' :
                $action_type  = 'REPACK_OUTLIFE';
                $module_name  = 'Batches';
                break;
            case 'direct_deduct':
                $action_type  = 'DIRECT_DEDUCT';
                $module_name  = 'Batches';
                break;
            case 'deduct_track_outlife':
                $action_type  = 'DEDUCT_TRACK_OUTLIFE';
                $module_name  = 'RepackOutlife';
                break;
        }
        LogSheet::updateOrCreate([
            'ip'          => request()->ip(),
            'agent'       => request()->header('user-agent'),
            'user_id'     => auth_user()->id,
            'user_name'   => auth_user()->alias_name,
            'module_name' => $module_name,
            'action_type' => $action_type,
            'old'         => json_encode($old),
            'new'         => json_encode($new),
            'module_id'   => $old->id ?? ''
        ]);
    }

    public static function all()
    {
        return LogSheet::latest()->get();
    }
}

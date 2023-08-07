<?php

namespace Database\Seeders;

use App\Models\tableOrder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TableOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parentTable            =   Schema::getColumnListing("material_products");
        $childTable             =   Schema::getColumnListing("batches");
        $allColumns             =   array_merge($parentTable, $childTable);
        $tableColumns           =   array_combine($allColumns,$allColumns );
        unset(
            $tableColumns['id'],
            $tableColumns['withdrawal_type'],
            $tableColumns['created_at'],
            $tableColumns['updated_at'],
            $tableColumns['deleted_at'],
            $tableColumns['coc_coa_mill_cert_status'],
            $tableColumns['repack_size'],
            $tableColumns['actions'],
            $tableColumns['end_of_batch'],
            $tableColumns['access'],
            $tableColumns['coc_coa_mill_cert'],
            $tableColumns['iqc_result'],
            $tableColumns['sds'],
            $tableColumns['fm_1202'],
            $tableColumns['remarks'],
            $tableColumns['extended_qc_result'],
            $tableColumns['disposal_certificate'],
            $tableColumns['used_for_td_certificate'],
            $tableColumns['iqc_result_status'],
            $tableColumns['is_read'],
            $tableColumns['user_id'],
            $tableColumns['outlife_seconds'],
            $tableColumns['updated_outlife'],
            $tableColumns['disposed_after'],
            $tableColumns['disposed_status'],
            $tableColumns['extended_status'],
            $tableColumns['reconciliation_status'],
            $tableColumns['system_stock'],
            $tableColumns['physical_stock'],
            $tableColumns['quantity_color'],
            $tableColumns['material_quantity'],
            $tableColumns['material_total_quantity'],
            $tableColumns['quantity_update_status'],
            $tableColumns['end_of_material_product'],
            $tableColumns['notification_status'],
            $tableColumns['is_draft'],
        );
        $i = 0;
        foreach($tableColumns as $key => $value) {
            if($value == 'category_selection') {
                $data   = 1;
                $status = false;
            }  elseif($value == 'item_description') {
                $data   = 2;
                $status = true;
            }  elseif($value == 'brand') {
                $data   = 3;
                $status = true;
            } elseif($value == 'supplier') {
                $data   = 4;
                $status = false;
            }  elseif($value == 'unit_of_measure') {
                $data   = 5;
                $status = true;
            } elseif($value == 'unit_packing_value') {
                $data   = 6;
                $status = true;
            }elseif($value == 'quantity') {
                $data   = 7;
                $status = true;
            }elseif($value == 'total_quantity') {
                $data   = 8;
                $status = true;
            }elseif($value == 'batch') {
                $data   = 9;
                $status = false;
            }elseif($value == 'serial') {
                $data   = 10;
                $status = false;
            }elseif($value == 'po_number') {
                $data   = 11;
                $status = false;
            }elseif($value == 'statutory_body') {
                $data   = 12;
                $status = false;
            }elseif($value == 'euc_material') {
                $data   = 13;
                $status = false;
            }elseif($value == 'require_bulk_volume_tracking') {
                $data   = 14;
                $status = false;
            }elseif($value == 'require_outlife_tracking') {
                $data   = 15;
                $status = false;
            }elseif($value == 'outlife') {
                $data   = 16;
                $status = false;
            }elseif($value == 'storage_area') {
                $data   = 17;
                $status = true;
            }elseif($value == 'housing_type') {
                $data   = 18;
                $status = true;
            }elseif($value == 'housing') {
                $data   = 19;
                $status = true;
            }elseif($value == 'owner_one') {
                $data   = 20;
                $status = true;
            }elseif($value == 'owner_two') {
                $data   = 21;
                $status = true;
            }elseif($value == 'department') {
                $data   = 22;
                $status = true;
            }elseif($value == 'date_in') {
                $data   = 23;
                $status = false;
            }elseif($value == 'date_of_expiry') {
                $data   = 24;
                $status = true;
            }elseif($value == 'iqc_status') {
                $data   = 25;
                $status = false;
            }elseif($value == 'cas') {
                $data   = 26;
                $status = false;
            }elseif($value == 'project_name') {
                $data   = 27;
                $status = false;
            }elseif($value == 'material_product_type') {
                $data   = 28;
                $status = false;
            }elseif($value == 'alert_threshold_qty_upper_limit') {
                $data   = 29;
                $status = false;
            }elseif($value == 'alert_threshold_qty_lower_limit') {
                $data   = 30;
                $status = false;
            }elseif($value == 'alert_before_expiry') {
                $data   = 31;
                $status = false;
            }elseif($value == 'date_of_manufacture') {
                $data   = 32;
                $status = false;
            }elseif($value == 'date_of_shipment') {
                $data   = 33;
                $status = false;
            }elseif($value == 'cost_per_unit') {
                $data   = 34;
                $status = false;
            }elseif($value == 'extended_expiry') {
                $data   = 35;
                $status = false;
            }elseif($value == 'extended_qc_status') {
                $data   = 36;
                $status = false;
            }elseif($value == 'used_for_td_expt_only') {
                $data   = 37;
                $status = true;
            } elseif($value == 'barcode_number') {
                $data   = 38;
                $status = true;
            } 
            tableOrder::create([
                'order_by' => $data ?? $i + 1,
                'column'   => $value,
                'status'   => $status ?? false
            ]);
            $i++;
        }
    }
}

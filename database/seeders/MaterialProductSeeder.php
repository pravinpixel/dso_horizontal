<?php

namespace Database\Seeders;

use App\Models\Batches;
use App\Models\MaterialProducts;
use Illuminate\Database\Seeder;

class MaterialProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent_data = [
            "category_selection"              => "material",
            "item_description"                => "Honeycomb/6mmthk/5mmcellsize",
            "unit_of_measure"                 => "4",
            "unit_packing_value"              => "100",
            "alert_threshold_qty_upper_limit" => "100",
            "alert_threshold_qty_lower_limit" => "10",
            "alert_before_expiry"             => "704",
            "quantity"                        => 175,
        ];
        $data = [
            "is_draft"                        => "0",
            "quantity"                     => 175,
            "brand"                        => "Hexcel",
            "supplier"                     => "Peter Parker",
            "batch"                        => "19F482MBi64",
            "serial"                       => "31R000043777",
            "po_number"                    => "10001",
            "statutory_body"               => "4",
            "euc_material"                 => "0",
            "require_bulk_volume_tracking" => "0",
            "require_outlife_tracking"     => "0",
            "outlife"                      => "20",
            "storage_area"                 => "5",
            "housing_type"                 => "9",
            "housing"                      => "15",
            "owner_one"                    => "Ainsley",
            "owner_two"                    => "Mia",
            "department"                   => "5",
            "access"                       => json_encode(["4"]),
            "date_in"                      => "2005-12-22",
            "date_of_expiry"               => "2023-01-01",
            "coc_coa_mill_cert_status"     => "on",
            "iqc_status"                   => "1",
            "iqc_result_status"            => "on",
            "cas"                          => "Honorato Sweet",
            "fm_1202"                      => "on",
            "project_name"                 => "Lillith Pena",
            "material_product_type"        => "Felix Santiago",
            "date_of_manufacture"          => "2022-07-06",
            "date_of_shipment"             => "2002-12-20",
            "cost_per_unit"                => "465",
            "remarks"                      => "Kimberly Snider",
            "used_for_td_expt_only"        => "1",
            "barcode_number"               => '114220115600'
        ];
        $material_product = MaterialProducts::create($parent_data);
        $batch_one = $material_product->Batches()->create($data);

        $current_batch_one = Batches::find($batch_one->id);
        if($current_batch_one->require_bulk_volume_tracking == 0 && $current_batch_one->require_outlife_tracking == 0) {
            $withdrawal_type = 'DIRECT_DEDUCT';
        }
        if($current_batch_one->require_bulk_volume_tracking == 1 && $current_batch_one->require_outlife_tracking == 0) {
            $withdrawal_type = 'DEDUCT_TRACK_USAGE';
        }
        if($current_batch_one->require_bulk_volume_tracking == 1 && $current_batch_one->require_outlife_tracking == 1) {
            $withdrawal_type = 'DEDUCT_TRACK_OUTLIFE';
        }
        $current_batch_one->update([
            'withdrawal_type' => $withdrawal_type
        ]);

        $parent_data_two = [
            "category_selection"              => "in_house",
            "item_description"                => "Acetone 90% Ind grade",
            "unit_of_measure"                 => "8",
            "unit_packing_value"              => "175",
            "alert_threshold_qty_upper_limit" => "150",
            "alert_threshold_qty_lower_limit" => "35",
            "alert_before_expiry"             => "850",
            "quantity"                        => 250,
        ];
        $data_two = [
            "is_draft"                      => "0",
            "quantity"                     => 155,
            "brand"                        => "In-House",
            "supplier"                     => "Peter Parker",
            "batch"                        => "19F482MBi64",
            "serial"                       => "31R000043777",
            "po_number"                    => "10201",
            "statutory_body"               => "2",
            "euc_material"                 => "0",
            "require_bulk_volume_tracking" => "1",
            "require_outlife_tracking"     => "0",
            "outlife"                      => "20",
            "storage_area"                 => "5",
            "housing_type"                 => "9",
            "housing"                      => "15",
            "owner_one"                    => "Hesbrew",
            "owner_two"                    => "Elena",
            "department"                   => "3",
            "access"                       => json_encode(["4"]),
            "date_in"                      => "2022-12-22",
            "date_of_expiry"               => "2023-01-01",
            "coc_coa_mill_cert_status"     => "on",
            "iqc_status"                   => "1",
            "iqc_result_status"            => "on",
            "cas"                          => "Honorato Sweet",
            "fm_1202"                      => "on",
            "project_name"                 => "Lillith Pena",
            "material_product_type"        => "Felix Santiago",
            "date_of_manufacture"          => "2022-05-06",
            "date_of_shipment"             => "2002-12-20",
            "cost_per_unit"                => "465",
            "remarks"                      => "Kimberly Snider",
            "used_for_td_expt_only"        => "1",
            "barcode_number"               => '214820155609'
        ];
        $material_product_two = MaterialProducts::create($parent_data_two);
        $batch_two = $material_product_two->Batches()->create($data_two);
        $current_batch_two = Batches::find($batch_two->id);
        if($current_batch_two->require_bulk_volume_tracking == 0 && $current_batch_two->require_outlife_tracking == 0) {
            $withdrawal_type = 'DIRECT_DEDUCT';
        }
        if($current_batch_two->require_bulk_volume_tracking == 1 && $current_batch_two->require_outlife_tracking == 0) {
            $withdrawal_type = 'DEDUCT_TRACK_USAGE';
        }
        if($current_batch_two->require_bulk_volume_tracking == 1 && $current_batch_two->require_outlife_tracking == 1) {
            $withdrawal_type = 'DEDUCT_TRACK_OUTLIFE';
        }
        $current_batch_two->update([
            'withdrawal_type' => $withdrawal_type
        ]);


        $parent_data_three = [
            "category_selection"              => "in_house",
            "item_description"                => "Acetone 90% Ind grade",
            "unit_of_measure"                 => "8",
            "unit_packing_value"              => "175",
            "alert_threshold_qty_upper_limit" => "150",
            "alert_threshold_qty_lower_limit" => "35",
            "alert_before_expiry"             => "850",
            "quantity"                        => 250,
        ];
        $data_three = [
            "is_draft"                      => "0",
            "quantity"                     => 155,
            "brand"                        => "In-House",
            "supplier"                     => "Alan walker",
            "batch"                        => "112R482MBi64",
            "serial"                       => "87R000043777",
            "po_number"                    => "25201",
            "statutory_body"               => "3",
            "euc_material"                 => "1",
            "require_bulk_volume_tracking" => "1",
            "require_outlife_tracking"     => "1",
            "outlife"                      => "25",
            "storage_area"                 => "3",
            "housing_type"                 => "5",
            "housing"                      => "15",
            "owner_one"                    => "Elena",
            "owner_two"                    => "Hesbrew",
            "department"                   => "2",
            "access"                       => json_encode(["4"]),
            "date_in"                      => "2022-11-20",
            "date_of_expiry"               => "2023-01-01",
            "coc_coa_mill_cert_status"     => "on",
            "iqc_status"                   => "1",
            "iqc_result_status"            => "on",
            "cas"                          => "Honorato Sweet",
            "fm_1202"                      => "on",
            "project_name"                 => "Lillith Pena",
            "material_product_type"        => "Felix Santiago",
            "date_of_manufacture"          => "2022-05-06",
            "date_of_shipment"             => "2002-12-20",
            "cost_per_unit"                => "465",
            "remarks"                      => "Kimberly Snider",
            "used_for_td_expt_only"        => "1",
            "barcode_number"               => '214820155601'
        ];
        $material_product_three = MaterialProducts::create($parent_data_three);
        $batch_three = $material_product_three->Batches()->create($data_three);
        $current_batch_three = Batches::find($batch_three->id);
        if($current_batch_three->require_bulk_volume_tracking == 0 && $current_batch_three->require_outlife_tracking == 0) {
            $withdrawal_type = 'DIRECT_DEDUCT';
        }
        if($current_batch_three->require_bulk_volume_tracking == 1 && $current_batch_three->require_outlife_tracking == 0) {
            $withdrawal_type = 'DEDUCT_TRACK_USAGE';
        }
        if($current_batch_three->require_bulk_volume_tracking == 1 && $current_batch_three->require_outlife_tracking == 1) {
            $withdrawal_type = 'DEDUCT_TRACK_OUTLIFE';
        }
        $current_batch_three->update([
            'withdrawal_type' => $withdrawal_type
        ]);
    } 
}
<?php

namespace Database\Seeders;

use App\Interfaces\BarCodeLabelRepositoryInterface;
use App\Models\MaterialProducts;
use Illuminate\Database\Seeder;

class MaterialProductSeeder extends Seeder
{
    public function __construct(BarCodeLabelRepositoryInterface $barCodeLabelRepository)    {
        $this->barCodeLabelRepository = $barCodeLabelRepository;
    }
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
            "require_outlife_tracking"     => "1",
            "outlife"                      => "20",
            "storage_area"                 => "5",
            "housing_type"                 => "9",
            "housing"                      => "15",
            "owner_one"                    => "Christopher",
            "owner_two"                    => "Chris",
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
        ];
        $material_product = MaterialProducts::create($parent_data);
        $batch            = $material_product->Batches()->create($data);
        $this->barCodeLabelRepository->generateBarcode($material_product, $batch);
    }
}
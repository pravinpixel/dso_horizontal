<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialProducts extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'date_in' => 'date:d-m-Y'
    ];

    protected $fillable = [
        'category_selection',
        'barcode_number',
        'item_description',
        'in_house_product_logsheet_id',
        'brand',
        'supplier',
        'unit_packing_size',
        'quantity',
        'batch',
        'serial',
        'po_number',
        'statutory_body',
        'euc_material',

        'storage_room',
        'house_type',
        'owner_one',
        'owner_two',
        'department',
        'access',
        'date_in',
        'date_of_expiry',
        'iqc_status',
        'sds_mill_cert_document',
        'coc_coa_mill_cert_document',
        'iqc_result',

        'cas',
        'fm_1202',
        'project_name',
        'project_type',
        'extended_expiry',
        'extended_qc_status',
        'extended_qc_result',
        'upload_disposal_certificate',
        'alert_threshold_qty_for_new',
        'alert_before_expiry',
        'date_of_manufacture',
        'date_of_shipment',
        'cost_per_unit',
        'remarks',
    ];
} 
<?php

namespace App\Models;

use App\Models\Masters\Departments;
use App\Models\Masters\HouseTypes;
use App\Models\Masters\StatutoryBody;
use App\Models\Masters\StorageRoom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Batches extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_draft',
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

    public function BarCodeGenOne()
    {
        return $this->hasMany(BarCodeGenOne::class, 'batch_id', 'id');
    } 

    public function BatchMaterialProduct()
    {
        return $this->hasOne(MaterialProducts::class, 'id', 'material_product_id');
    } 

    public function BatchBarcode()
    {
        return $this->hasOne(BarcodeFormat::class, 'batch_id', 'id');
    }

    public function RepackOutlife()
    {
        return $this->hasMany(RepackOutlife::class, 'batch_id', 'id');
    }
    public function HousingType()
    {
        return  $this->hasOne(HouseTypes::class, 'id', 'housing_type'); 
    }

    public function Department()
    {
        return  $this->hasOne(Departments::class, 'id', 'department'); 
    } 

    public function StorageArea()
    {
        return  $this->hasOne(StorageRoom::class, 'id', 'storage_area'); 
    }  
    
    public function StatutoryBody()
    {
        return  $this->hasOne(StatutoryBody::class, 'id', 'statutory_body'); 
    }
}
<?php

namespace App\Models;

use App\Models\Masters\Departments;
use App\Models\Masters\HouseTypes;
use App\Models\Masters\StatutoryBody;
use App\Models\Masters\StorageRoom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Batches extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'notification_status',
        'is_draft',
        'material_product_id',
        'brand',
        'supplier',
        'unit_packing_value',
        'quantity',
        'total_quantity',
        'quantity_color',
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
        'owners',
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
        'no_of_extension',
        'extended_qc_status',
        'extended_qc_result',
        'disposal_certificate',
        'used_for_td_certificate',
        'used_for_td_expt_only',
        'actions',
        'repack_size',
        'barcode_number',
        'iqc_result_status',
        'withdrawal_type',
        'outlife_seconds',
        'disposed_after',
        'disposed_status',
        'extended_status',
        'reconciliation_status',
        'system_stock',
        'physical_stock',
        'updated_outlife',
        'user_id',
        'end_of_batch',
        'initial_outlife_date'
    ];

    public function BarCodeGenOne()
    {
        return $this->hasMany(BarCodeGenOne::class, 'batch_id', 'id');
    }

    public function BatchFiles()
    {
        return $this->hasMany(BatchFiles::class, 'batch_id', 'id');
    }

    public function UtilizationCart()
    {
        return $this->hasMany(UtilizationCart::class, 'batch_id', 'id');
    }

    public function BatchOwners()
    {
        return $this->hasMany(BatchOwners::class, 'batch_id', 'id');
    }
    public function BatchMaterialProduct()
    {
        return $this->hasOne(MaterialProducts::class, 'id', 'material_product_id')->withTrashed();
    }

    public function BatchBarcode()
    {
        return $this->hasOne(BarcodeFormat::class, 'batch_id', 'id');
    }
    public function RepackOutlifeDrawInOut()
    {
        return $this->hasMany(RepackOutlife::class, 'batch_id', 'id')->where('draw_in', 1)->where('draw_out', 1);
    }
    public function RepackOutlife()
    {
        return $this->hasMany(RepackOutlife::class, 'batch_id', 'id');
    }
    public function DrawInOutlife()
    {
        return $this->hasMany(RepackOutlife::class, 'batch_id', 'id')->where(['draw_in' => 0,'draw_out' => 1]);//outlife->draw_in == 0 && $outlife->draw_out == 1
    }
    public function DrawInOutlifeLatest()
    {
        return $this->hasOne(RepackOutlife::class, 'batch_id', 'id')->where(['draw_in' => 1,'draw_out' => 1])->latest();//outlife->draw_in == 0 && $outlife->draw_out == 1
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

    public function DeductTrackUsage()
    {
        return $this->hasMany(DeductTrackUsage::class, 'batch_id', 'id');
    }

    public function TrackOutlifeHistory()
    {
        return $this->hasMany(TrackOutlifeHistory::class, 'batch_id', 'id');
    }
     public function LatestBatchFiles()
    {
        return $this->hasMany(BatchFiles::class, 'batch_id', 'id')->where('column_name','used_for_td_certificate')->withTrashed()->orderBy('id','desc');
    }
}

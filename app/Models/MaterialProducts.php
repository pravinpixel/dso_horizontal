<?php

namespace App\Models;

use App\Models\Masters\PackingSizeData;
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
        'item_description',
        'unit_of_measure',
        'unit_packing_value',
        'alert_threshold_qty_upper_limit',
        'alert_threshold_qty_lower_limit',
        'alert_before_expiry',
        'end_of_material_product',
        'material_quantity',
        'quantity_update_status',
        'material_total_quantity',
        'material_quantity_color',
        'is_draft',
        'is_read'
    ];
    public function NonDraftBatches()
    {
        return $this->hasMany(Batches::class, 'material_product_id', 'id')->where('is_draft',0);
    }
    public function Batches()
    {
        return $this->hasMany(Batches::class, 'material_product_id', 'id');
    }
    public function UnitOfMeasure()
    {
        return  $this->hasOne(PackingSizeData::class, 'id', 'unit_of_measure');
    }
}

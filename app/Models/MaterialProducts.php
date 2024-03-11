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
    public function NotifyedBatches()
    {
        return $this->hasMany(Batches::class, 'material_product_id', 'id')->where('notification_status',0);
    }
    public function Batches()
    {
    if(hasAdmin()){
      return $this->hasMany(Batches::class, 'material_product_id', 'id');
    }else{
    if(request()->route()->getName()=="get-batch-material-products" || request()->route()->getName()=="create.material-product" || request()->route()->getName()=="edit_or_duplicate.material-product" || request()->route()->getName()=="home.get-material-products" || request()->route()->getName()=="list-material-products-export"){
            return $this->hasMany(Batches::class, 'material_product_id', 'id');
    }else{
    return $this->hasMany(Batches::class, 'material_product_id', 'id')->whereRaw('FIND_IN_SET("'.auth_user()->id.'",owners)');
    }
    }
    }
    public function UnitOfMeasure()
    {
        return  $this->hasOne(PackingSizeData::class, 'id', 'unit_of_measure');
    }
    
}

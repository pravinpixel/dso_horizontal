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
        'barcode_number',
        'is_draft',
        'category_selection',
        'item_description',
        'unit_of_measure',
        'unit_packing_value',
        'owner_one',
        'owner_two',
        'statutory_body',
        'alert_threshold_qty_upper_limit',
        'alert_threshold_qty_lower_limit',
        'alert_before_expiry',
    ];

    public function batch()
    {
        return $this->hasMany(Batches::class, 'material_product_id', 'id');
    }
} 
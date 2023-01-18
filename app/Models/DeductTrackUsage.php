<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductTrackUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'quantity',
        'barcode_number',
        'item_description',
        'batch_serial',
        'last_accessed',
        'used_amount',
        'remain_amount',
        'remarks',
        'brand',
        'unit_packing_value',
        'storage_area',
        'housing',
    ];
}

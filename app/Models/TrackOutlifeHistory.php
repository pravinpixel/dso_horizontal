<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackOutlifeHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'item_description',
        'batch_serial',
        'last_accessed',
        'unit_packing_value',
        'quantity',
        'total_quantity',
        'withdraw_quantity',
        'remarks'
    ];
}

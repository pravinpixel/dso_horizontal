<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductTrackUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'item_description',
        'batch_serial',
        'last_accessed',
        'used_amount',
        'remain_amount',
        'remarks',
    ];
}

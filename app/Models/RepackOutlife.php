<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepackOutlife extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time_stamp',
        'last_access',
        'input_repack_amount',
        'remain_amount',
        'unique_barcode_label',
        'repack_size',
        'qty_cut',
        'quantity',
        'remain_days',
    ];
}
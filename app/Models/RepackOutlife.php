<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepackOutlife extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'quantity',
        'draw_in',
        'draw_out',
        'draw_in_time_stamp',
        'draw_out_time_stamp',
        'draw_in_last_access',
        'draw_out_last_access',
        'input_repack_amount',
        'remain_amount',
        'unique_barcode_label',
        'repack_size',
        'qty_cut',
        'remain_days',
    ];
}
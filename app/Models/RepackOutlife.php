<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RepackOutlife extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'batch_id',
        'quantity',
        'total_quantity',
        'draw_in',
        'draw_out',
        'draw_in_time_stamp',
        'draw_out_time_stamp',
        'draw_in_last_access',
        'draw_out_last_access',
        'input_repack_amount',
        'old_input_repack_amount',
        'remain_amount',
        'barcode_number',
        'repack_size',
        'remain_days',
        'last_date_time',
        'current _date_time',
        'remaining_days_seconds',
        'updated_outlife',
        'updated_outlife_seconds',
        'current_outlife_expiry',
        'remarks',
        'current_date_time',
        'user_id'
    ];
    public function Batch()
    {
        return $this->hasOne(Batches::class, 'id', 'batch_id');
    }
    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
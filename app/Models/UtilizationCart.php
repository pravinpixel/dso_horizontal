<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilizationCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'quantity'
    ];

    public function getCreatedAtAttribute($date) {
        return Carbon::parse($date)->format('F');
    }

    public function Batch()
    {
        return $this->hasOne(Batches::class, 'id', 'batch_id');
    }
}

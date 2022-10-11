<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchTracker extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_batch_id',
        'to_batch_id',
        'action_type',
        'action_by',
    ];
}

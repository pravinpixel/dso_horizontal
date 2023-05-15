<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NEFNotification extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'batch_id', 
    ];
    public function Batches()
    {
        return $this->hasOne(Batches::class, 'id', 'batch_id');
    }
}

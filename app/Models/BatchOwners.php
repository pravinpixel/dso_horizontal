<?php

namespace App\Models;

use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchOwners extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'user_id',
        'alias_name'
    ];
    public function Batches()
    {
        return $this->hasOne(Batches::class, 'id', 'batch_id');
    } 
}

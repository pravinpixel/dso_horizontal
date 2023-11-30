<?php

namespace App\Models;

use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BatchOwners extends Model
{
    use HasFactory,SoftDeletes;

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

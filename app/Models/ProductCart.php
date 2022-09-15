<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'user_id',
        'type'
    ];
    
    public function Batches()
    {
        return $this->hasOne(Batches::class, 'id','batch_id');
    }
}
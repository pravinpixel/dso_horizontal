<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class withdrawCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'batch_id',
        'withdraw_type',
        'quantity'
    ];

    public function batch()
    {
        return $this->hasOne(Batches::class, 'id', 'batch_id');
    }

    public function RepackOutlife()
    {
        return $this->hasMany(RepackOutlife::class, 'batch_id', 'batch_id');
    } 
}
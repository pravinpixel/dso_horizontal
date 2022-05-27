<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarCodeGenTwo extends Model
{
    use HasFactory;

    public function BarCodeGenThree()
    {
        return $this->hasOne(BarCodeGenThree::class, 'gen_two_id', 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarCodeGenOne extends Model
{
    use HasFactory;
    protected $fillable =[ 
        "category_selection",
        "description",
        "brand",
        "self_gen_one",
    ];
    
    public function BarCodeGenTwo()
    {
        return $this->hasMany(BarCodeGenTwo::class, 'gen_one_id', 'id');
    }
}
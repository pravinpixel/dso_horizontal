<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarCodeFormat extends Model
{
    use HasFactory;
    protected $fillable = [
        "material_product_id",
        "batch_id",
        "category_selection",
        "description",
        "brand",
        "self_gen_one",
        "batch",
        "serial",
        "self_gen_two",
        "repack_one",
        "repack_two",
        "self_gen_three",
        "barcode_label",
    ];
}
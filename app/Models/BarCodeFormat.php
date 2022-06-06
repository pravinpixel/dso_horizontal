<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarcodeFormat extends Model
{
    use HasFactory;
    protected $fillable = [
        "batch_id",
        "category_selection",
        "item_description",
        "brand",
        "self_gen_one",
        "batch",
        "serial",
        "self_gen_two",
        "repack_one",
        "repack_two",
        "self_gen_three",
        "barcode_label",
        "is_self_gen_two"
    ];
}
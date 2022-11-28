<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposedItems extends Model
{
    use HasFactory;
    protected $fillable = [
        "TransactionDate",
        "TransactionTime",
        "TransactionBy",
        "ItemDescription",
        "BatchSerial",
        "UnitPackingValue",
        "BeforeQuantity",
        "Quantity",
        "user_id",
    ];
}

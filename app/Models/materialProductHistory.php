<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materialProductHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'barcode_number',
        'CategorySelection',
        'ItemDescription',
        'Brand',
        'BatchSerial',
        'TransactionBy',
        'Module',
        'ActionTaken',
        'UnitPackingValue',
        'Quantity',
        'StorageArea',
        'Housing',
        'Owners',
        'Remarks',
        'DrawStatus',
        'RemainingOutlifeOfParent'
    ];
}

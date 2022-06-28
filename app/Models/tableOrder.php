<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tableOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'column',
        'status',
        'order_by'
    ];

    static  function getTableColumn()
    {
        $result = tableOrder::orderBy('order_by')->get();
        $column = [];
        foreach ($result as $key => $value) { 
            $column[$value->column] = [
                "name"      =>  $value->column,
                "status"    =>  $value->status
            ]; 
        }
        return $column;
    }
}
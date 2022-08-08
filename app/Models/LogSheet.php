<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogSheet extends Model
{
    use HasFactory; 

    protected   $fillable = [
        'ip',
        'agent',
        'user_id',
        'action_type' ,
    ];
}
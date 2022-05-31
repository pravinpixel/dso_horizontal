<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveMySearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'search_title', 
        'search_data', 
    ];
}

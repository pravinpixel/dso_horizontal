<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'user_id',
        'type',
        'file_path',
        'action',
        'file_id'
    ]; 
}

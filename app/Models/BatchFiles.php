<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BatchFiles extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'batch_id',
        'column_name',
        'original_name',
        'file_name',
        'file_extension',
        'file_path',
    ];
}

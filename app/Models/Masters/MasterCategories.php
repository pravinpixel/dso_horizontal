<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCategories extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
}

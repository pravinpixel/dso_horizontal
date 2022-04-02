<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'attachments',
        'status'
    ];
}
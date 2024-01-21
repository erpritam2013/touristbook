<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileDeleteHistory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'generated_conversions'=>'array',
    ];
}

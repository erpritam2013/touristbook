<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'highlights' => 'array',
        'facilityAmenities' => 'array',
        'foods' => 'array',
        'complimentary' => 'array',
        'helpfulfacts' => 'array',
        'pocketPDF' => 'array',
        'landmark' => 'array',
        'todo' => 'array',
        'offers' => 'array',
        'todovideo' => 'array',
        'eventmeeting' => 'array',
        'tourismzonepdf' => 'array',
        'activities' => 'array',
        'transport' => 'array',
        'emergencyLinks' => 'array',
        'social_links' => 'array',
    ];

}

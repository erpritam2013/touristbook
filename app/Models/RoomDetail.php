<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'discount_by_day' => 'array',
        'gallery' => 'array',
        'add_new_facility' => 'array',
        'social_links' => 'array',
        'hotel_alone_room_layout' => 'boolean',
        'price_by_per_person' => 'boolean',
        'allow_full_day' => 'boolean',
        'disable_adult_name' => 'boolean',
        'disable_children_name' => 'boolean',
        'st_room_external_booking' => 'boolean',
        'st_allow_cancel' => 'boolean',
        'is_meta_payment_gateway_st_submit_form' => 'boolean',
        'check_editing' => 'boolean',
        'deposit_payment_amount' => 'float',
        'calendar_price' => 'float',
    ];
}

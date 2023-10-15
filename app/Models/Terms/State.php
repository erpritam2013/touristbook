<?php

namespace App\Models\Terms;

use App\Models\TourismZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class State extends Model
{
    use HasFactory;
    use Sluggable;

    const ACTIVE = 1;
    const INACTIVE = 0;

    const HOTEL_TYPE = "Hotel";

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'parent_id',
        'country',
        'extra_data',
        'status',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function tourism_zones() {
        return $this->hasMany(TourismZone::class, 'state_id');
    }
}

<?php

namespace App\Models;

use App\Models\RoomDetail;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\Terms\Facility;
use App\Models\Terms\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use LamaLama\Wishlist\HasWishlists;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class Room extends Model
{
    use HasFactory, Sluggable, SoftDeletes,HasWishlists;

    protected $guarded = [];

    protected $casts = [
        'extra_price' => 'array',
        'price'=>'float',
        'adult_price'=>'float',
        'child_price'=>'float',
        'featured_image'=> 'array',
        'editing_expiry_time' => 'datetime'
        
    ];

    public function sluggable(): Array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

     public function edited() {
        $this->fill([
            'editor_id' => Auth::user()->id,
            'is_editing' => true,
            'editing_expiry_time' => Carbon::now()->addMinutes(5)
        ]);
        $this->save();
    }

       public function editor_name()
    {
        if ($this->is_editing && $this->editor_id && !$this->editing_expiry_time->isPast()) {
            return User::find($this->editor_id)->name;
        }


    }

    public function freeEditing() {
        $this->is_editing = false;
        $this->save();
    }
    public function isEditing() {
        return $this->is_editing && !$this->editing_expiry_time->isPast() && $this->editor_id != Auth::user()->id;
    }

     public function facilities() {
        return $this->belongsToMany(Facility::class, 'room_facilities', 'room_id', 'facility_id');
    }

    public function types() {
        return $this->belongsToMany(Type::class, 'room_types', 'room_id', 'type_id');
    }

      public function locations() {
        return $this->belongsToMany(Location::class, 'room_locations', 'room_id', 'location_id');
    }

    public function hotels() {
        return $this->hasOne(Hotel::class,'id','hotel_id');
    }
    public function detail() {
        return $this->hasOne(RoomDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}

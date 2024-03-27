<?php

namespace App\Models;
use App\Models\Terms\Place;
use App\Models\Terms\State;
use App\Models\Terms\Type;
use App\Models\User;
use App\Models\LocationMeta;
use App\Models\HotelLocation;
use App\Models\TourLocation;
use App\Models\ActivityLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class Location extends Model
{
    use HasFactory,Sluggable, SoftDeletes;

    const ACTIVE = 1;
    const INACTIVE = 0;
    protected $guarded = [];

    //  protected $appends = [
    //     'hotel_count',
    //     'tour_count',
    //     'activity_count'
    // ];

    protected $casts = [
        'featured_image'=> 'array',
        'logo'=> 'array',
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
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    
    public function hotels() {
        return $this->hasMany(HotelLocation::class);
    }
    public function tours() {
        return $this->hasMany(TourLocation::class);
    }
    public function activities() {
        return $this->hasMany(ActivityLocation::class);
    }

      public function hotel_count() {
        return $this->hotels()->select([DB::raw('COUNT(id) as count')]);
    } 
    public function tour_count() {
        return $this->tours()->select([DB::raw('COUNT(id) as count')]);
    } 
    public function activity_count() {
        return $this->activities()->select([DB::raw('COUNT(id) as count')]);
    } 

    public function places() {
        return $this->belongsToMany(Place::class, 'location_places', 'location_id', 'place_id');
    }
    public function types() {
        return $this->belongsToMany(Type::class, 'location_types', 'location_id', 'type_id');
    }
    public function states() {

    return $this->belongsToMany(State::class, 'location_states', 'location_id', 'state_id');
    }
    public function locationMeta()
    {
        return $this->hasOne(LocationMeta::class);
    }
}

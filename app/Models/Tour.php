<?php

namespace App\Models;

use App\Models\Location;
use App\Models\TourDetail;
use App\Models\User;
use App\Models\CountryZone;
use App\Models\Terms\Type;
use App\Models\Terms\OtherPackage;
use App\Models\Terms\PackageType;
use App\Models\Terms\Language;
use App\Models\Terms\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class Tour extends Model
{
    use HasFactory, Sluggable;
    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $guarded = [];

    protected $casts = [
        'discount_by_child' => 'array',
        'discount_by_adult' => 'array',
        'featured_image' => 'array',
        'extra_price' => 'array',
        'is_featured'=>'boolean',
        'hide_adult_in_booking_form'=>'boolean',
        'hide_children_in_booking_form'=>'boolean',
        'hide_infant_in_booking_form'=>'boolean',
        'disable_adult_name'=>'boolean',
        'disable_children_name'=>'boolean',
        'disable_infant_name'=>'boolean',
        'price'=>'float',
        'sale_price'=>'float',
        'child_price'=>'float',
        'adult_price'=>'float',
        'infant_price'=>'float',
        'min_price'=>'float',
        'rate_review'=>'float',
        'deposit_payment_amount'=>'float',
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


    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function isEditing() {
        return $this->is_editing && !$this->editing_expiry_time->isPast() && $this->editor_id != Auth::user()->id;
    }

    public function types() {
        return $this->belongsToMany(Type::class, 'tour_types', 'tour_id', 'type_id');
    }

    public function other_packages() {
        return $this->belongsToMany(OtherPackage::class, 'tour_other_packages', 'tour_id', 'other_package_id');
    }
    public function package_types() {
        return $this->belongsToMany(PackageType::class, 'tour_package_types', 'tour_id', 'package_type_id');
    }


    public function locations() {
        return $this->belongsToMany(Location::class, 'tour_locations', 'tour_id', 'location_id');
    }

    public function languages() {
        return $this->belongsToMany(Language::class, 'tour_languages', 'tour_id', 'language_id');
    }

    public function states() {
        return $this->belongsToMany(State::class, 'tour_states', 'tour_id', 'state_id');
    }

    public function country_zone() {

        return $this->belongsTo(CountryZone::class,'country_zone_id','id');
    }
    public function detail() {

        return $this->hasOne(TourDetail::class);
    }
}

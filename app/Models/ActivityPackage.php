<?php

namespace App\Models;
use App\Models\ActivityPackageActivity;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class ActivityPackage extends Model
{
    use HasFactory,Sluggable, SoftDeletes;

    protected $table = "activity_packages";
     protected $casts = [
        'editing_expiry_time' => 'datetime'
    ];
    protected $guarded = [];

       public function sluggable(): Array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function activity_list() {
        return $this->belongsToMany(Activity::class, 'activity_package_activities','activity_package_id','activity_id');
    }

     public function edited() {
        $this->fill([
            'editor_id' => Auth::user()->id,
            'is_editing' => true,
            'editing_expiry_time' => Carbon::now()->addMinutes(5)
        ]);
        $this->save();
    }

    public function freeEditing() {
        $this->is_editing = false;
        $this->save();
    }
    public function editor_name()
    {
        if ($this->is_editing && $this->editor_id && !$this->editing_expiry_time->isPast()) {
            return User::find($this->editor_id)->name;
        }


    }
    public function isEditing() {
        return $this->is_editing && !$this->editing_expiry_time->isPast() && $this->editor_id != Auth::user()->id;
    }

     public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}

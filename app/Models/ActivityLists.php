<?php

namespace App\Models;
use App\Models\Activity;
use App\Models\User;
use App\Models\ActivityLists;
use App\Models\CustomIcon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class ActivityLists extends Model
{
    use HasFactory,Sluggable, SoftDeletes;

    protected $table = "activity_lists";
    protected $guarded = [];
    protected $casts = [
        'activity_list_section'=>'array',
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

    public function activity_list() {
        return $this->belongsToMany(Activity::class, 'activity_lists_activities','activity_list_id','activity_id');
    }
    // public function activity() {
    //     return $this->hasOne(Activity::class);
    // }

}

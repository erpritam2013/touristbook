<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class TourismZone extends Model
{
    use HasFactory,Sluggable, SoftDeletes;

    protected $table = "tourism_zones";
    protected $guarded = [];
    protected $casts = [
        'tourism_zone'=>'array',
        'image'=>'array',
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
}

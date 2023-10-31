<?php

namespace App\Models;
use App\Models\ActivityPackageActivity;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ActivityPackage extends Model
{
    use HasFactory,Sluggable;

    protected $table = "activity_packages";
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
}

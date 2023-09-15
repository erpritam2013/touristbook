<?php

namespace App\Models;
use App\Models\ActivityPackageActivity;
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
}

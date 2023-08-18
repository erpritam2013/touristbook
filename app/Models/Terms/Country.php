<?php

namespace App\Models\Terms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
       'countrycode',
       'countryname',
       'code',
   ];
}

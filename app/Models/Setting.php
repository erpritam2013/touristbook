<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

     static public function save_setting($name,$value){
        $setting = self::where('name', $name)->get()->count();
        $save_setting = array('name' =>$name,
                              'value'=>$value
                        );

        if($setting==0){
            $save_setting['name'] = $name;
            self::insert($save_setting);
        }else{

            self::where('name', $name)->update($save_setting);
        }
    }

    static public function get_setting($name){
        $setting=self::where('name', $name)->get(['value'])->first();
        if(!empty($setting)){
            return $setting->value;
        }
        return "";

    }
   public $timestamps = false;
}

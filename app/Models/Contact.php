<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Mail\ContactFormSubmission;
   
class Contact extends Model
{
    use HasFactory;
   
    public $fillable = ['name', 'email', 'phone', 'subject', 'message'];
   
    /**
     * Write code on Method
     *
     * @return response()
     */
    // public static function boot() {
   
    //     parent::boot();
   
    //     static::created(function ($item) {
    //         $emails = exploreJsonData(get_settings_option_value('email_address'));
    //         $adminEmail = (isset($emails[0]))?$emails[0]:'info@thetouristbook.com';
    //         Mail::to($adminEmail)->send(new ContactFormSubmission($item));
    //     });
    // }
}
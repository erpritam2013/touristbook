<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\Tour;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\ActivityZone;
use App\Models\CountryZone;
use App\Models\TourismZone;
use App\Models\ActivityLists;
use App\Models\Terms\Facility;
use App\Models\Terms\Amenity;
use Auth;
class AdminController extends Controller
{
     function dashboard()
     {
       

         $data['title'] = "Dashboard";
         $data['activities'] = Activity::count();
         $data['hotels'] = Hotel::count();
         $data['rooms'] = Room::count();
         $data['tours'] = Tour::count();
         $data['locations'] = Location::count();
         $data['posts'] = Post::count();
         $data['pages'] = Page::count();
         $data['activity_zones'] = ActivityZone::count();
         $data['country_zones'] = CountryZone::count();
         $data['tourism_zones'] = TourismZone::count();
         $data['activity_lists'] = ActivityLists::count();
         $data['users'] = User::count();

         return view('admin.dashboard',$data);
     }
     function terms()
     {
         $data['title'] = "Terms";
         $data['facilities'] = Facility::count();
         $data['amenities'] = Amenity::count();

         return view('admin.terms.terms',$data);
     }
     function profile()
     {
         $user = Auth::user();
         $data['title'] = "Profile";
         $data['user'] =  $user;
         return view('admin.profile',$data);

     }
}

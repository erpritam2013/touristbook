<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\Terms\Facility;
use App\Models\Terms\Amenity;
class AdminController extends Controller
{
     function dashboard()
     {

         $data['title'] = "Dashboard";
         $data['activities'] = Activity::count();
         $data['hotels'] = Hotel::count();
         $data['rooms'] = 0;
         $data['locations'] = Location::count();

         return view('admin.dashboard',$data);
     }
     function terms()
     {
         $data['title'] = "Terms";
         $data['facilities'] = Facility::count();
         $data['amenities'] = Amenity::count();

         return view('admin.terms.terms',$data);
     }
}

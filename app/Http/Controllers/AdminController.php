<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terms\Facility;
use App\Models\Terms\Amenity;
class AdminController extends Controller
{
     function dashboard()
     {
         return view('admin.dashboard');
     }
     function terms()
     {
         $data['title'] = "Terms";
         $data['facilities'] = Facility::count();
         $data['amenities'] = Amenity::count();

         return view('admin.terms.terms',$data);
     }
}

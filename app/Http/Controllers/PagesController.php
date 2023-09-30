<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    public function index() {

        return view('sites.pages.home');
    }

    public function hotels() {

        return view('sites.pages.hotels');
    }

    public function getHotels(Request $request, $view = "list") {

        $hotelQuery = Hotel::query();

        if($request->has('range') && !empty($request->get('range'))) {
            $range = explode(";", $request->get('range'));
            // TODO: Need Proper Validation
            $minimum = $range[0];
            $maximum = $range[1];

            $hotelQuery->whereBetween("avg_price", [$minimum, $maximum]);
        }

        $hotels = $hotelQuery->paginate();
        // TODO: Include Status Check
        // $hotelQuery->where('status', Hotel::)
        return View::make('sites.partials.results.hotel', ['hotels' => $hotels, 'view' => $view]);

    }
}

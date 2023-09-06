<?php

namespace App\Http\Controllers;

use App\Interfaces\LocationRepositoryInterface;
use App\Interfaces\PlaceRepositoryInterface;
use App\Interfaces\StateRepositoryInterface;
use App\Interfaces\TypeRepositoryInterface;
use App\Interfaces\CountryRepositoryInterface;
use App\Models\Location;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;

class LocationController extends Controller
{

  private LocationRepositoryInterface $locationRepository;
  private PlaceRepositoryInterface $placeRepository;
  private StateRepositoryInterface $stateRepository;
  private TypeRepositoryInterface $typeRepository;
  private CountryRepositoryInterface $countryRepository;

  public function __construct(
    LocationRepositoryInterface $locationRepository,
    PlaceRepositoryInterface $placeRepository,
    StateRepositoryInterface $stateRepository,
    TypeRepositoryInterface $typeRepository,
    CountryRepositoryInterface $countryRepository,

)
  {
    $this->locationRepository = $locationRepository;
    $this->placeRepository = $placeRepository;
    $this->stateRepository = $stateRepository;
    $this->typeRepository = $typeRepository;
    $this->countryRepository = $countryRepository;

}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $data['locations'] = $this->locationRepository->getAllLocations();
        return view('admin.locations.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Location';
        // TODO: Need to Improve here (Fetch from Cache)
        $data['places'] = $this->placeRepository->getActiveLocationPlacesList();
        $data['states'] = $this->stateRepository->getActiveStatesList();
        $data['types'] = $this->typeRepository->getActiveLocationTypesList();
        $data['countries'] = $this->countryRepository->getCountiesList();
        
        return view('admin.locations.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationRequest $request)
    {



      $locationDetails = [
        "name" => $request->name,
        "description" => $request->description,
        //logo s3 integration pending
        "color" => $request->color,
        "is_featured" => $request->is_featured,
        "country" => $request->country,
        "zipcode" => $request->zipcode,
        "map_address" => $request->map_address,
        "latitude" => $request->latitude,
        "longitude" => $request->longitude,
        "zoom_level" => $request->zoom_level,
        "state_id" => $request->state_id,
        'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $location = $this->locationRepository->createLocation($locationDetails);

    if($location) {
        $locationMeta = [ 

         "location_id" => $location->id,
         "location_for_filter" => json_encode($request->location_for_filter),
         "location_content" => json_encode($request->location_content),
         "child_tabs" => json_encode($request->child_tabs),
         "place_to_visit_description" => $request->place_to_visit_description,
         "place_to_visit" => json_encode($request->place_to_visit),
         "best_time_to_visit" => json_encode($request->best_time_to_visit),
         "best_time_to_visit_description" => $request->best_time_to_visit_description,
         "how_to_reach_description" => $request->how_to_reach_description,
         "how_to_reach" => json_encode($request->how_to_reach),
         "fair_and_festivals_description" => $request->fair_and_festivals_description,
         "fair_and_festivals_image" => $request->fair_and_festivals_image,
         "fair_and_festivals" => json_encode($request->fair_and_festivals),
         "culinary_retreat_description" => $request->culinary_retreat_description,
         "culinary_retreat" => json_encode($request->culinary_retreat),
         "shopaholics_anonymous_description" => $request->shopaholics_anonymous_description,
         "shopaholics_anonymous" => json_encode($request->shopaholics_anonymous),
         "weather" => json_encode($request->weather),
         "location_map" => json_encode($request->location_map),
         "what_to_do" => json_encode($request->what_to_do),
         "stay" => $request->stay,
         "packages" => $request->packages,
         "get_to_know_image" => $request->get_to_know_image,
         "save_your_pocket_image" => $request->save_your_pocket_image,
         "save_your_pocket" => json_encode($request->save_your_pocket),
         "save_your_environment_image" => $request->save_your_environment_image,
         "save_your_environment" => json_encode($request->save_your_environment),
         "faqs" => json_encode($request->faqs),
         "hotel_activities" => json_encode($request->hotel_activities),
         "by_aggregators" => json_encode($request->by_aggregators),
         "location_video" => json_encode($request->location_video),
         "gallery" => json_encode($request->gallery),
         "b_govt_subsidiaries" => json_encode($request->b_govt_subsidiaries),
         "by_hotels" => json_encode($request->by_hotels),
         "important_note" => $request->important_note,
         "sanstive_data" => $request->sanstive_data,
         "helpful_facts" => $request->helpful_facts
     ];

     $this->locationRepository->createLocationMeta($locationMeta);
     $location->types()->attach($request->get('location_type'));
     $location->places()->attach($request->get('places'));
 }
 return $location;
        // return redirect()->Route('tasks');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationRequest  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}

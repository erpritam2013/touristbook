<?php

namespace App\Http\Controllers;

use App\Interfaces\LocationRepositoryInterface;
use App\Interfaces\PlaceRepositoryInterface;
use App\Interfaces\StateRepositoryInterface;
use App\Interfaces\TypeRepositoryInterface;
use App\Interfaces\CountryRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Location;
use Session;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\DataTables\LocationDataTable;
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
    TypeRepositoryInterface $typeRepository,
    StateRepositoryInterface $stateRepository,
    CountryRepositoryInterface $countryRepository,

)
  {
    $this->locationRepository = $locationRepository;
    $this->placeRepository = $placeRepository;
    $this->typeRepository = $typeRepository;
    $this->stateRepository = $stateRepository;
    $this->countryRepository = $countryRepository;

}


private function _prepareBasicData() {

        // TODO: Need to Improve here (Fetch from Cache)
    $data['places'] = $this->placeRepository->getActiveLocationPlacesList();
    $data['states'] = $this->stateRepository->getActiveStatesList()->map(function($value, $key){  
        
      return (object)[
        'id' => $value->id,
        'value' => $value->name,
        'parent_id' => $value->name,
    ];                                

});
        //$data['states'] = getTermsForSelectBox('State');
    $data['types'] = $this->typeRepository->getActiveLocationTypesList();
    $data['countries'] = $this->countryRepository->getCountiesList();

    return $data;

}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LocationDataTable $dataTable)
    {

     // $data['locations'] = $this->locationRepository->getAllLocations();
      $data['locations'] = Location::count();
      $data['title'] = 'Location List';
      return $dataTable->render('admin.locations.index', $data);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        
        $data['title'] = 'Location Add';
        $data['location'] = new Location();
        $data = array_merge_recursive($data, $this->_prepareBasicData());

        // TODO: Need to Improve here (Fetch from Cache)
        
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
         'slug' => SlugService::createSlug(Location::class, 'slug', $request->name),
        //logo s3 integration pending
        "color" => $request->color,
        "is_featured" => $request->is_featured,
        "country" => $request->country,
        "zipcode" => $request->zipcode,
        "map_address" => $request->map_address,
        "latitude" => $request->latitude,
        "longitude" => $request->longitude,
        "zoom_level" => $request->zoom_level,
        'featured_image' => $request->featured_image,
        'logo' => $request->logo,
        'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];
  
    $location = $this->locationRepository->createLocation($locationDetails);
    
    if($location) {

     $location->locationMeta()->create($request->only([
        "location_for_filter",
        "location_content",
        "child_tabs",
        "place_to_visit_description",
        "place_to_visit",
        "best_time_to_visit",
        "best_time_to_visit_description",
        "how_to_reach_description",
        "how_to_reach",
        "fair_and_festivals_description",
        "fair_and_festivals_image",
        "fair_and_festivals",
        "culinary_retreat_description",
        "culinary_retreat",
        "shopaholics_anonymous_description",
        "shopaholics_anonymous",
        "weather",
        "location_map",
        "what_to_do",
        "stay",
        "packages",
        "get_to_know",
        "get_to_know_image",
        "save_your_pocket_image",
        "save_your_pocket",
        "save_your_environment_image",
        "save_your_environment",
        "faqs",
        "hotel_activities",
        "by_aggregators",
        "location_video",
        "gallery",
        "b_govt_subsidiaries",
        "by_hotels",
        "important_note",
        "sanstive_data",
        "helpful_facts",

    ]));
    
     $location->types()->attach($request->get('type'));
     $location->places()->attach($request->get('places'));
     $location->states()->attach($request->get('state_id'));


 }
   //return $location;
 return redirect()->Route('admin.locations.index');
}

public function changeStatus(Request $request): JsonResponse
{
    $locationId = $request->id;
    $locationDetails = [
        'status' => $request->status,
    ];
    $this->locationRepository->updateLocation($locationId, $locationDetails);
    
    return response()->json(['success'=>'Status change successfully.']);
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
    public function edit($id)
    {
  
  
       $location = Location::with(['places', 'states', 'types'])->find($id);

       if (empty($location)) {
        return back();
    }
    $data['title'] = 'Location Edit';
    $data['location'] = $location;
    $data = array_merge_recursive($data, $this->_prepareBasicData());

    
        // TODO: Need to Improve here (Fetch from Cache)
    
    return view('admin.locations.edit', $data);
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
        'status' => $request->status,
        'featured_image' => $request->featured_image,
        'logo' => $request->logo,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $this->locationRepository->updateLocation($location->id,$locationDetails);

    
    if($location) {
     

   
     $location->locationMeta()->update($request->only([
        "location_for_filter",
        "location_content",
        "child_tabs",
        "place_to_visit_description",
        "place_to_visit",
        "best_time_to_visit",
        "best_time_to_visit_description",
        "how_to_reach_description",
        "how_to_reach",
        "fair_and_festivals_description",
        "fair_and_festivals_image",
        "fair_and_festivals",
        "culinary_retreat_description",
        "culinary_retreat",
        "shopaholics_anonymous_description",
        "shopaholics_anonymous",
        "weather",
        "location_map",
        "what_to_do",
        "stay",
        "packages",
        "get_to_know",
        "get_to_know_image",
        "save_your_pocket_image",
        "save_your_pocket",
        "save_your_environment_image",
        "save_your_environment",
        "faqs",
        "hotel_activities",
        "by_aggregators",
        "location_video",
        "gallery",
        "b_govt_subsidiaries",
        "by_hotels",
        "important_note",
        "sanstive_data",
        "helpful_facts",

    ]));

     $location->types()->sync($request->get('location_type'));
     $location->places()->sync($request->get('places'));
     $location->states()->sync($request->get('state_id'));
     
 }
 Session::flash('success','Location Updated Successfully');
 return redirect()->Route('admin.locations.edit',$location->id);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        if ($location) {
            $locationId = $location->id;

            $this->locationRepository->deleteLocation($locationId);
            Session::flash('success','Location Deleted Successfully');
        }else{
            Session::flash('error','Location Not Found!');
        }
        return back();
    }

    public function bulk_delete(Request $request)
    {
       if (!empty($request->ids)) {
        
        $locationIds = get_array_mapping(json_decode($request->ids));
        $this->locationRepository->deleteBulkLocation($locationIds);
        Session::flash('success','Location Bulk Deleted Successfully');
    }
    return back();
}

}

<?php

namespace App\Http\Controllers;
use App\Interfaces\CountryZoneRepositoryInterface;
use App\Models\Terms\Country;
use App\Models\CountryZone;
use App\Http\Requests\StoreCountryZoneRequest;
use App\Http\Requests\UpdateCountryZoneRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\CountryZoneDataTable;
class CountryZoneController extends Controller
{
  private CountryZoneRepositoryInterface $countryZoneRepository;

  public function __construct(
    CountryZoneRepositoryInterface $countryZoneRepository,
) {
    $this->countryZoneRepository = $countryZoneRepository;
}

private function _prepareBasicData() {

        // TODO: Need to Improve here (Fetch from Cache)
    $data['countries'] = getCountries();
    return $data;

}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountryZoneDataTable $dataTable)
    {
     $data['country_zones'] = CountryZone::count();
     $data['title'] = 'Country Zone List';

     return $dataTable->render('admin.country-zones.index', $data);
 }

 public function changeStatus(Request $request): JsonResponse
 {
    $countryZoneId = $request->id;
    $countryZoneDetails = [
        'status' => $request->status,
    ];
    $this->countryZoneRepository->updateCountryZone($countryZoneId, $countryZoneDetails);

    return response()->json(['success' => 'Status change successfully.']);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Country Zone Add';
        $data['country_zone'] = new CountryZone();
        $data = array_merge_recursive($data, $this->_prepareBasicData());
        return view('admin.country-zones.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCountryZoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryZoneRequest $request)
    {
    
       $countryZoneDetails = [
        'title' => $request->title,
        'sub_title' => $request->sub_title,
        'slug' => SlugService::createSlug(CountryZone::class, 'slug', $request->title),

        'country' => $request->country,
            // 'icon' => $request->icon, //s3 integration pending
            // 'image' => $request->image, //s3 integration pending
        'country_zone_description' => $request->country_zone_description,
        'country_zone_section' => $request->country_zone_section,
        'country_zone_catering' => $request->country_zone_catering,
        'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $country_zone = $this->countryZoneRepository->createCountryZone($countryZoneDetails);
    Session::flash('success','Country Zone Created Successfully');
    return redirect()->Route('admin.country-zones.index');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CountryZone  $countryZone
     * @return \Illuminate\Http\Response
     */
    public function show(CountryZone $countryZone)
    {
       $countryZoneId = $countryZone->id;

       $country_zone = $this->countryZoneRepository->getCountryZoneById($countryZoneId);

       if (empty($country_zone)) {
        return back();
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CountryZone  $countryZone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country_zone = CountryZone::find($id);

        if (empty($country_zone)) {
            return back();
        }

        $data['title'] = 'Country Zone Edit';
        $data['country_zone'] = $country_zone;
        $data = array_merge_recursive($data, $this->_prepareBasicData());
        return view('admin.country-zones.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountryZoneRequest  $request
     * @param  \App\Models\CountryZone  $countryZone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryZoneRequest $request, CountryZone $countryZone)
    {
      $countryZoneDetails = [
        'title' => $request->title,
        'sub_title' => $request->sub_title,
        'slug' => (!empty($request->slug) && $countryZone->slug != $request->slug)?SlugService::createSlug(CountryZone::class, 'slug', $request->slug):$countryZone->slug,

        'country' => $request->country,
            // 'icon' => $request->icon, //s3 integration pending
            // 'image' => $request->image, //s3 integration pending
        'country_zone_description' => $request->country_zone_description,
        'country_zone_section' => $request->country_zone_section,
        'country_zone_catering' => $request->country_zone_catering,
        'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $country_zone = $this->countryZoneRepository->updateCountryZone($countryZone->id,$countryZoneDetails);
    Session::flash('success','Country Zone Updated Successfully');
    return redirect()->Route('admin.country-zones.edit',$countryZone->id);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CountryZone  $countryZone
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountryZone $countryZone)
    {
        $countryZoneId = $countryZone->id;

        $this->countryZoneRepository->deleteCountryZone($countryZoneId);
        Session::flash('success','Country Zone Deleted Successfully');
        return back();
    }


    public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $countryZoneIds = get_array_mapping(json_decode($request->ids));
            $this->countryZoneRepository->deleteBulkCountryZone($countryZoneIds);
            Session::flash('success', 'Country Zone Bulk Deleted Successfully');
        }
        return back();
    }
}

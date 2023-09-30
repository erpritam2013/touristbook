<?php

namespace App\Http\Controllers;
use App\Interfaces\TourismZoneRepositoryInterface;
use App\Models\Terms\Country;
use App\Models\TourismZone;
use App\Http\Requests\StoreTourismZoneRequest;
use App\Http\Requests\UpdateTourismZoneRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\TourismZoneDataTable;

class TourismZoneController extends Controller
{



 private TourismZoneRepositoryInterface $tourismZoneRepository;

 public function __construct(
    TourismZoneRepositoryInterface $tourismZoneRepository,
) {
    $this->tourismZoneRepository = $tourismZoneRepository;
}

private function _prepareBasicData() {

        // TODO: Need to Improve here (Fetch from Cache)
    //$data['countries'] = getCountries();
      $data['states'] = getPostData('Terms\\State',['id','name']);
    return $data;

}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TourismZoneDataTable $dataTable)
    {


       $data['tourism_zones'] = TourismZone::count();
       $data['title'] = 'Tourism Zone List';

       return $dataTable->render('admin.tourism-zones.index', $data);
   }

    public function changeStatus(Request $request): JsonResponse
   {
    $Id = $request->id;
    $newDetails = [
        'status' => $request->status,
    ];
    $this->tourismZoneRepository->updateTourismZone($Id, $newDetails);

    return response()->json(['success' => 'Status change successfully.']);
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['title'] = 'Tourism Zone Add';
        $data['tourism_zone'] = new TourismZone();
        $data = array_merge_recursive($data, $this->_prepareBasicData());
        return view('admin.tourism-zones.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTourismZoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourismZoneRequest $request)
    {
        $tourismZoneDetails = [
        'title' => $request->title,
        'sub_title' => $request->sub_title,
        'slug' => SlugService::createSlug(TourismZone::class, 'slug', $request->title),

        'state_id' => $request->state_id,
            // 'icon' => $request->icon, //s3 integration pending
            // 'image' => $request->image, //s3 integration pending
        'tourism_zone_description' => $request->tourism_zone_description,
        'tourism_zone' => $request->tourism_zone,
        'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $tourism_zone = $this->tourismZoneRepository->createTourismZone($tourismZoneDetails);
    Session::flash('success','Tourism Zone Created Successfully');
    return redirect()->Route('admin.tourism-zones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourismZone  $tourismZone
     * @return \Illuminate\Http\Response
     */
    public function show(TourismZone $tourismZone)
    {
          $tourismZoneId = $tourismZone->id;

     $tourism_zone = $this->tourismZoneRepository->getTourismZoneById($tourismZoneId);

     if (empty($tourism_zone)) {
        return back();
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TourismZone  $tourismZone
     * @return \Illuminate\Http\Response
     */
    public function edit(TourismZone $tourismZone)
    {
       $tourism_zone = $tourismZone;

        if (empty($tourism_zone)) {
            return back();
        }

        $data['title'] = 'Tourism Zone Edit';
        $data['tourism_zone'] = $tourism_zone;
        $data = array_merge_recursive($data, $this->_prepareBasicData());
        return view('admin.tourism-zones.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourismZoneRequest  $request
     * @param  \App\Models\TourismZone  $tourismZone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourismZoneRequest $request, TourismZone $tourismZone)
    {
         $tourismZoneDetails = [
        'title' => $request->title,
        'sub_title' => $request->sub_title,
        'slug' => (!empty($request->slug) && $tourismZone->slug != $request->slug)?SlugService::createSlug(TourismZone::class, 'slug', $request->slug):$tourismZone->slug,

       'state_id' => $request->state_id,
            // 'icon' => $request->icon, //s3 integration pending
            // 'image' => $request->image, //s3 integration pending
        'tourism_zone_description' => $request->tourism_zone_description,
        'tourism_zone' => $request->tourism_zone,
        'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $tourism_zone = $this->tourismZoneRepository->updateTourismZone($tourismZone->id,$tourismZoneDetails);
    Session::flash('success','Tourism Zone Updated Successfully');
    return redirect()->Route('admin.tourism-zones.edit',$tourismZone->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourismZone  $tourismZone
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourismZone $tourismZone)
    {
        //
    }
}

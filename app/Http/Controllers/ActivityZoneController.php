<?php

namespace App\Http\Controllers;
use App\Interfaces\ActivityZoneRepositoryInterface;
use App\Models\Terms\Country;
use App\Models\ActivityZone;
use App\Http\Requests\StoreActivityZoneRequest;
use App\Http\Requests\UpdateActivityZoneRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\ActivityZoneDataTable;

class ActivityZoneController extends Controller
{


 private ActivityZoneRepositoryInterface $activityZoneRepository;

 public function __construct(
    ActivityZoneRepositoryInterface $activityZoneRepository,
) {
    $this->activityZoneRepository = $activityZoneRepository;
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
    public function index(ActivityZoneDataTable $dataTable)
    {


       $data['activity_zones'] = ActivityZone::count();
       $data['title'] = 'Activity Zone List';

       return $dataTable->render('admin.activity-zones.index', $data);
   }

   public function changeStatus(Request $request): JsonResponse
   {
    $Id = $request->id;
    $newDetails = [
        'status' => $request->status,
    ];
    $this->activityZoneRepository->updateActivityZone($Id, $newDetails);

    return response()->json(['success' => 'Status change successfully.']);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['title'] = 'Activity Zone Add';
        $data['activity_zone'] = new ActivityZone();
        $data = array_merge_recursive($data, $this->_prepareBasicData());
        return view('admin.activity-zones.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivityZoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityZoneRequest $request)
    {
     $activityZoneDetails = [
        'title' => $request->title,
        'sub_title' => $request->sub_title,
        'slug' => SlugService::createSlug(ActivityZone::class, 'slug', $request->title),

        'country' => $request->country,
            // 'icon' => $request->icon, //s3 integration pending
            // 'image' => $request->image, //s3 integration pending
        'activity_zone_description' => $request->activity_zone_description,
        'activity_zone_section' => $request->activity_zone_section,
        'activity_zone_pdf' => $request->activity_zone_pdf,
        'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $activity_zone = $this->activityZoneRepository->createActivityZone($activityZoneDetails);
    Session::flash('success','Activity Zone Created Successfully');
    return redirect()->Route('admin.activity-zones.index');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityZone  $activityZone
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityZone $activityZone)
    {
     $activityZoneId = $activityZone->id;

     $activity_zone = $this->activityZoneRepository->getActivityZoneById($activityZoneId);

     if (empty($activity_zone)) {
        return back();
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityZone  $activityZone
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityZone $activityZone)
    {
        $activity_zone = $activityZone;

        if (empty($activity_zone)) {
            return back();
        }

        $data['title'] = 'Activity Zone Edit';
        $data['activity_zone'] = $activity_zone;
        $data = array_merge_recursive($data, $this->_prepareBasicData());
        return view('admin.activity-zones.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivityZoneRequest  $request
     * @param  \App\Models\ActivityZone  $activityZone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityZoneRequest $request, ActivityZone $activityZone)
    {
     $activityZoneDetails = [
        'title' => $request->title,
        'sub_title' => $request->sub_title,
        'slug' => (!empty($request->slug) && $activityZone->slug != $request->slug)?SlugService::createSlug(ActivityZone::class, 'slug', $request->slug):$activityZone->slug,

        'country' => $request->country,
            // 'icon' => $request->icon, //s3 integration pending
            // 'image' => $request->image, //s3 integration pending
        'activity_zone_description' => $request->activity_zone_description,
        'activity_zone_section' => $request->activity_zone_section,
        'activity_zone_pdf' => $request->activity_zone_pdf,
        'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $activity_zone = $this->activityZoneRepository->updateActivityZone($activityZone->id,$activityZoneDetails);
    Session::flash('success','Activity Zone Updated Successfully');
    return redirect()->Route('admin.activity-zones.edit',$activityZone->id);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityZone  $activityZone
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityZone $activityZone)
    {
        $activityZoneId = $activityZone->id;

        $this->activityZoneRepository->deleteActivityZone($activityZoneId);
        Session::flash('success','Activity Zone Deleted Successfully');
        return back();
    }


    public function bulk_delete(Request $request)
    {


        if (!empty($request->ids)) {

            $activityZoneIds = get_array_mapping(json_decode($request->ids));
            $this->activityZoneRepository->deleteBulkActivityZone($activityZoneIds);
            Session::flash('success', 'Activity Zone Bulk Deleted Successfully');
        }
        return back();
    }
}

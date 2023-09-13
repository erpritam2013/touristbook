<?php

namespace App\Http\Controllers;

use App\Interfaces\ActivityListsRepositoryInterface;
use App\Models\ActivityLists;
use App\Http\Requests\StoreActivityListsRequest;
use App\Http\Requests\UpdateActivityListsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\ActivityListsDataTable;

class ActivityListsController extends Controller
{

   private ActivityListsRepositoryInterface $activityListsRepository;

   public function __construct(
    ActivityListsRepositoryInterface $activityListsRepository,
) {
    $this->activityListsRepository = $activityListsRepository;
}

private function _prepareBasicData() {

        // TODO: Need to Improve here (Fetch from Cache)
   // $data['countries'] = Country::get(['id','countryname','code']);
    return $data;

}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ActivityListsDataTable $dataTable)
    {

       $data['activity_lists'] = ActivityLists::count();
       $data['title'] = 'Activity Lists';

       return $dataTable->render('admin.activity-lists.index', $data);
   }

   public function changeStatus(Request $request): JsonResponse
   {
    $Id = $request->id;
    $newDetails = [
        'status' => $request->status,
    ];
    $this->activityListsRepository->updateActivityLists($Id, $newDetails);

    return response()->json(['success' => 'Status change successfully.']);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $data['title'] = 'Activity Lists Add';
     $data['activity_list'] = new ActivityLists();
     $data = array_merge_recursive($data, $this->_prepareBasicData());
     return view('admin.activity-lists.create', $data);
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivityListsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityListsRequest $request)
    {
     $activityListsDetails = [
        'title' => $request->title,
        'sub_title' => $request->sub_title,
        'slug' => SlugService::createSlug(ActivityLists::class, 'slug', $request->title),
        
        'country' => $request->country,
            // 'icon' => $request->icon, //s3 integration pending
            // 'image' => $request->image, //s3 integration pending
        'activity_list_description' => $request->activity_list_description,
        'activity_list_section' => $request->activity_list_section,
        'activity_list_pdf' => $request->activity_list_pdf,
        'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $activity_list = $this->activityListsRepository->createActivityLists($activityListsDetails);
    Session::flash('success','Activity Lists Created Successfully');
    return redirect()->Route('admin.activity-lists.index');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityLists  $activityLists
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityLists $activityLists)
    {
       $activityListsId = $activityLists->id;

       $activity_list = $this->activityListsRepository->getActivityListsById($activityListsId);

       if (empty($activity_list)) {
        return back();
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityLists  $activityLists
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityLists $activityLists)
    {
     $activity_list = $ActivityLists;

     if (empty($activity_list)) {
        return back();
    }

    $data['title'] = 'Activity Lists Edit';
    $data['activity_list'] = $activity_list;
    $data = array_merge_recursive($data, $this->_prepareBasicData());
    return view('admin.activity-lists.edit', $data);
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivityListsRequest  $request
     * @param  \App\Models\ActivityLists  $activityLists
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityListsRequest $request, ActivityLists $activityLists)
    {
       $activityListsDetails = [
        'title' => $request->title,
        'sub_title' => $request->sub_title,
        'slug' => SlugService::createSlug(ActivityLists::class, 'slug', $request->title),
        
        'country' => $request->country,
            // 'icon' => $request->icon, //s3 integration pending
            // 'image' => $request->image, //s3 integration pending
        'activity_list_description' => $request->activity_list_description,
        'activity_list_section' => $request->activity_list_section,
        'activity_list_pdf' => $request->activity_list_pdf,
        'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $activity_list = $this->activityListsRepository->updateActivityLists($activityLists->id,$activityListsDetails);
    Session::flash('success','Activity Lists Updated Successfully');
    return redirect()->Route('admin.activity-lists.edit',$activityLists->id);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityLists  $activityLists
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityLists $activityLists)
    {
        $activityListsId = $activityLists->id;

        $this->activityListsRepository->deleteActivityLists($activityListsId);
        Session::flash('success','Activity Lists Deleted Successfully');
        return back();
    }

    public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $activityListsIds = get_array_mapping(json_decode($request->ids));
            $this->activityListsRepository->deleteBulkActivityLists($activityListsIds);
            Session::flash('success', 'Activity Lists Bulk Deleted Successfully');
        }
        return back();
    }
}

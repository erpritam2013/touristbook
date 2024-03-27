<?php

namespace App\Http\Controllers;

use App\Interfaces\ActivityListsRepositoryInterface;
use App\Interfaces\ActivityRepositoryInterface;
use App\Models\ActivityLists;
use App\Models\Activity;
use App\Models\CustomIcon;
use App\Http\Requests\StoreActivityListsRequest;
use App\Http\Requests\UpdateActivityListsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\ActivityListsDataTable;
use App\DataTables\TrashedActivityListsDataTable;
use Auth;
class ActivityListsController extends Controller
{

 private ActivityListsRepositoryInterface $activityListsRepository;

 public function __construct(
    ActivityListsRepositoryInterface $activityListsRepository,
    ActivityRepositoryInterface $activityRepository,
) {
    $this->activityListsRepository = $activityListsRepository;
    $this->activityRepository = $activityRepository;
}

private function _prepareBasicData() {

        // TODO: Need to Improve here (Fetch from Cache)

 $data['custom_icons'] = CustomIcon::get(['id','title','slug']);
 $data['activities'] = getPostData('Activity',['id','name']);

 
 return $data;

}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ActivityListsDataTable $dataTable)
    {
     if (isset(request()->user) && !empty(request()->user)) {
        $created_by = request()->user;
        $data['activity_lists'] = ActivityLists::where('created_by',$created_by)->count();
    }else{
     $data['activity_lists'] = ActivityLists::count();
 }
 $data['title'] = 'Activity Lists';
 $data['trashed'] = ActivityLists::onlyTrashed()->count();

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
        'slug' => SlugService::createSlug(ActivityLists::class, 'slug', $request->title),
        'description' => $request->description,
        'custom_icon' => $request->custom_icon,
        'status' => $request->status,
        'created_by' => (Auth::check())?Auth::user()->id:null,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $activity_list = $this->activityListsRepository->createActivityLists($activityListsDetails);
    if ($activity_list) {
        $activity_list->activity_list()->attach($request->get('activity_id'));
    }
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
    public function edit($id)
    {
       $activity_list = ActivityLists::find($id);

       if (empty($activity_list)) {
        return back();
    }

    if($activity_list->isEditing()) {
        Session::flash('error','Activity Lists is being Edited. Please wait till its fully edited!');
        return redirect()->Route('admin.activity-lists.index');
    }

        // Set Editing Status
    $activity_list->edited();

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
    public function update(UpdateActivityListsRequest $request,$id)
    {

     $activityLists = ActivityLists::find($id);
     $activityListsDetails = [
        'title' => $request->title,
        // 'slug' => (!empty($request->slug) && $activityLists->slug != $request->slug)?SlugService::createSlug(ActivityLists::class, 'slug', $request->slug):$activityLists->slug,
        'description' => $request->description,
        'custom_icon' => $request->custom_icon,
        'status' => $request->status,
        'created_by' => (Auth::check())?Auth::user()->id:null,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $this->activityListsRepository->updateActivityLists($activityLists->id,$activityListsDetails);

    if ($activityLists) {
        $activityLists->activity_list()->sync($request->get('activity_id'));
    }
    Session::flash('success','Activity Lists Updated Successfully');
    if(!is_null($request->iscompleted)) {
        $activityLists->freeEditing();
        return redirect()->Route('admin.activity-lists.index');
    }
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
        Session::flash('success','Activity Lists Trashed Successfully');
        return back();
    }

    public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $activityListsIds = get_array_mapping(json_decode($request->ids));
            $this->activityListsRepository->deleteBulkActivityLists($activityListsIds);
            Session::flash('success', 'Activity Lists Bulk Trashed Successfully');
        }
        return back();
    }

    public function trashed_activitylists(TrashedActivityListsDataTable $dataTable)
{

    $trashed_activityLists = ActivityLists::onlyTrashed()->get();
    $data['trashed_count'] = $trashed_activityLists->count();
        //$data['trashed_activityLists'] = $trashed_activityLists;
    $data['title'] = 'Trash Activity Lists List';
        // dump(ActivityLists::onlyTrashed()->get());
        // dd( $data['trashed']);
    return $dataTable->render('admin.activity-list.trashed', $data);
}

public function restore_activityLists(Request $request)
{
    $ids = [];
    if (!empty($request->ids)) {
       $ids =  get_array_mapping(json_decode($request->ids));

   }

   if (!empty($ids)) {
     ActivityLists::whereIn('id',$ids)->withTrashed()->restore();
 }else{
   ActivityLists::onlyTrashed()->restore();
}
Session::flash('success','Activity Lists Restored Successfully');
return redirect()->back();
}

public function restore_activityList(Request $request,$id)
{
    $activityLists = ActivityLists::withTrashed()->find($id);
    if ($activityLists == null)
    {
        abort(404);
    }

    $activityLists->restore();
    Session::flash('success','Activity Lists Restored Successfully');
    return redirect()->back();
}
public function bulk_force_delete(Request $request)
{


    if (!empty($request->fd_ids)) {

        $activityListsIds = get_array_mapping(json_decode($request->fd_ids));
        $this->activityListsRepository->forceBulkDeleteActivityLists($activityListsIds);
        Session::flash('success', 'Activity Lists Bulk Permanent Deleted Successfully');
    }
    return back();
}

public function permanent_delete($id)
{
    $this->activityListsRepository->forceDeleteActivityLists($id);
    Session::flash('success','Activity Lists Permanent Deleted Successfully');
    return back();
}
public function empty_trashed(Request $request)
{

    ActivityLists::onlyTrashed()->forceDelete();
    Session::flash('success','Activity Lists Empty Trashed Successfully');
    return redirect()->back();
}
}

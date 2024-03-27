<?php

namespace App\Http\Controllers;

use App\Interfaces\ActivityPackageRepositoryInterface;
use App\Models\ActivityPackage;
use App\Http\Requests\StoreActivityPackageRequest;
use App\Http\Requests\UpdateActivityPackageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\ActivityPackageDataTable;
use App\DataTables\TrashedActivityPackageDataTable;
use Auth;
class ActivityPackageController extends Controller
{

     private ActivityPackageRepositoryInterface $activityPackageRepository;

   public function __construct(
    ActivityPackageRepositoryInterface $activityPackageRepository,
) {
    $this->activityPackageRepository = $activityPackageRepository;
}

private function _prepareBasicData() {

        // TODO: Need to Improve here (Fetch from Cache)
   $data['custom_icons'] = getPostData('CustomIcon',['id','title']);
   // $data['activities'] = getPostData('Activity',['id','name']);
   $data['activities'] = getPostData('Activity',['id','name']);;
    return $data;

}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ActivityPackageDataTable $dataTable)
    {
         if (isset(request()->user) && !empty(request()->user)) {
            $created_by = request()->user;
        $data['activity_packages'] = ActivityPackage::where('created_by',$created_by)->count();
        }else{
        $data['activity_packages'] = ActivityPackage::count();
        }
       $data['title'] = 'Activity Package';
    $data['trashed'] = ActivityPackage::onlyTrashed()->count();
       return $dataTable->render('admin.activity-packages.index', $data);
    }

     public function changeStatus(Request $request): JsonResponse
   {
    $Id = $request->id;
    $newDetails = [
        'status' => $request->status,
    ];
    $this->activityPackageRepository->updateActivityPackage($Id, $newDetails);

    return response()->json(['success' => 'Status change successfully.']);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $data['title'] = 'Activity Package Add';
     $data['activity_package'] = new ActivityPackage();
     $data = array_merge_recursive($data, $this->_prepareBasicData());
     return view('admin.activity-packages.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivityPackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityPackageRequest $request)
    {
        $activityPackageDetails = [
        'title' => $request->title,
        'slug' => SlugService::createSlug(ActivityPackage::class, 'slug', $request->title),
        'description' => $request->description,
        'duration' => $request->duration,
        'price' => $request->price ?? 0,
        'amenities' => $request->amenities,
        'custom_icon' => $request->custom_icon,
        'status' => $request->status,
        'created_by' => (Auth::check())?Auth::user()->id:null,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $activity_packages = $this->activityPackageRepository->createActivityPackage($activityPackageDetails);
    if ($activity_packages) {
        $activity_packages->activity_list()->attach($request->get('activity_id'));
    }
    Session::flash('success','Activity Package Created Successfully');
    return redirect()->Route('admin.activity-packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityPackage  $activityPackage
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityPackage $activityPackage)
    {
       $activityPackageId = $activityPackage->id;

       $activity_package = $this->activityPackageRepository->getActivityPackageById($activityPackageId);

       if (empty($activity_package)) {
        return back();
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityPackage  $activityPackage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $activity_package = ActivityPackage::find($id);

     if (empty($activity_package)) {
        return back();
    }

    if($activity_package->isEditing()) {
            Session::flash('error','Activity Package is being Edited. Please wait till its fully edited!');
            return redirect()->Route('admin.activity-packages.index');
        }

        // Set Editing Status
        $activity_package->edited();

    $data['title'] = 'Activity Package Edit';
    $data['activity_package'] = $activity_package;
    $data = array_merge_recursive($data, $this->_prepareBasicData());
    return view('admin.activity-packages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivityPackageRequest  $request
     * @param  \App\Models\ActivityPackage  $activityPackage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityPackageRequest $request, $id)
    {
        $activityPackage = ActivityPackage::find($id);
       $activityPackageDetails = [
        'title' => $request->title,
        'slug' => (!empty($request->slug) && $activityPackage->slug != $request->slug)?SlugService::createSlug(ActivityPackage::class, 'slug', $request->slug):$activityPackage->slug,
        'description' => $request->description,
        'duration' => $request->duration,
        'price' => $request->price ?? 0,
        'amenities' => $request->amenities,
        'custom_icon' => $request->custom_icon,
        'status' => $request->status,
        'created_by' => (Auth::check())?Auth::user()->id:null,
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $this->activityPackageRepository->updateActivityPackage($activityPackage->id,$activityPackageDetails);
    if ($activityPackage) {
        $activityPackage->activity_list()->sync($request->get('activity_id'));
    }
    Session::flash('success','Activity Package Updated Successfully');
    if(!is_null($request->iscompleted)) {
    $activityPackage->freeEditing();
    return redirect()->Route('admin.activity-packages.index');
}
    return redirect()->Route('admin.activity-packages.edit',$activityPackage->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityPackage  $activityPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->activityPackageRepository->deleteActivityPackage($id);
        Session::flash('success','Activity Package Trashed Successfully');
        return back();
    }

     public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $activityPackageIds = get_array_mapping(json_decode($request->ids));
            $this->activityPackageRepository->deleteBulkActivityPackage($activityPackageIds);
            Session::flash('success', 'Activity Package Bulk Trashed Successfully');
        }
        return back();
    }
    public function trashed_activityPackages(TrashedActivityPackageDataTable $dataTable)
{

    $trashed_activityPackages = ActivityPackage::onlyTrashed()->get();
    $data['trashed_count'] = $trashed_activityPackages->count();
        //$data['trashed_activityPackages'] = $trashed_activityPackages;
    $data['title'] = 'Trash Activity Package List';
        // dump(ActivityPackage::onlyTrashed()->get());
        // dd( $data['trashed']);
    return $dataTable->render('admin.activity-packages.trashed', $data);
}

public function restore_activityPackages(Request $request)
{
    $ids = [];
    if (!empty($request->ids)) {
       $ids =  get_array_mapping(json_decode($request->ids));

   }

   if (!empty($ids)) {
     ActivityPackage::whereIn('id',$ids)->withTrashed()->restore();
 }else{
   ActivityPackage::onlyTrashed()->restore();
}
Session::flash('success','Activity Package Restored Successfully');
return redirect()->back();
}

public function restore_activityPackage(Request $request,$id)
{
     $activityPackage = ActivityPackage::withTrashed()->find($id);
    if ( $activityPackage == null)
    {
        abort(404);
    }

     $activityPackage->restore();
    Session::flash('success','Activity Package Restored Successfully');
    return redirect()->back();
}
public function bulk_force_delete(Request $request)
{


    if (!empty($request->fd_ids)) {

         $activityPackageIds = get_array_mapping(json_decode($request->fd_ids));
        $this->activityPackageRepository->forceBulkDeleteActivityPackage( $activityPackageIds);
        Session::flash('success', 'Activity Package Bulk Permanent Deleted Successfully');
    }
    return back();
}

public function permanent_delete($id)
{
    $this->activityPackageRepository->forceDeleteActivityPackage($id);
    Session::flash('success','Activity Package Permanent Deleted Successfully');
    return back();
}
public function empty_trashed(Request $request)
{

    ActivityPackage::onlyTrashed()->forceDelete();
    Session::flash('success','Activity Package Empty Trashed Successfully');
    return redirect()->back();
}
}

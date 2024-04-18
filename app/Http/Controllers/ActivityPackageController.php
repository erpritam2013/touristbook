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
        $data['activity_packages'] = ActivityPackage::count();
       $data['title'] = 'Activity Package';

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
            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    $this->activityPackageRepository->updateActivityPackage($activityPackage->id,$activityPackageDetails);
    if ($activityPackage) {
        $activityPackage->activity_list()->sync($request->get('activity_id'));
    }
    Session::flash('success','Activity Package Updated Successfully');
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
        Session::flash('success','Activity Package Deleted Successfully');
        return back();
    }

     public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $activityPackageIds = get_array_mapping(json_decode($request->ids));
            $this->activityPackageRepository->deleteBulkActivityPackage($activityPackageIds);
            Session::flash('success', 'Activity Package Bulk Deleted Successfully');
        }
        return back();
    }
}

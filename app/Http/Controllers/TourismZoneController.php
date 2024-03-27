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
use Auth;
use App\DataTables\TourismZoneDataTable;
use App\DataTables\TrashedTourismZoneDataTable;

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

     if (isset(request()->user) && !empty(request()->user)) {
        $created_by = request()->user;
        $data['tourism_zones'] = TourismZone::where('created_by',$created_by)->count();
    }else{
       $data['tourism_zones'] = TourismZone::count();
   }
   $data['title'] = 'Tourism Zone List';
   $data['trashed'] = TourismZone::onlyTrashed()->count();
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
            'sub_title' => (!empty($request->sub_title))?$request->sub_title:'',
            'slug' => SlugService::createSlug(TourismZone::class, 'slug', $request->title),

            'state_id' => !empty($request->state_id)?$request->state_id:null,
            // 'icon' => $request->icon, //s3 integration pending
        'image' => $request->image, //s3 integration pending
        'tourism_zone_description' => $request->tourism_zone_description,
        'tourism_zone' => $request->tourism_zone,
        'status' => $request->status,
        'created_by' => (Auth::check())?Auth::user()->id:null,
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

    if($tourism_zone->isEditing()) {
        Session::flash('error','Tourism Zone is being Edited. Please wait till its fully edited!');
        return redirect()->Route('admin.tourism_zones.index');
    }

        // Set Editing Status
    $tourism_zone->edited();

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
        //'slug' => (!empty($request->slug) && $tourismZone->slug != $request->slug)?SlugService::createSlug(TourismZone::class, 'slug', $request->slug):$tourismZone->slug,

        'state_id' => !empty($request->state_id)?$request->state_id:null,
            // 'icon' => $request->icon, //s3 integration pending
       'image' => $request->image, //s3 integration pending
       'tourism_zone_description' => $request->tourism_zone_description,
       'tourism_zone' => (is_array($request->tourism_zone))?$request->tourism_zone:null,
       'status' => $request->status,
       'created_by' => (Auth::check())?Auth::user()->id:null,
            // TODO: created_by pending as Authentication is not Yet Completed
   ];
   
   $tourism_zone = $this->tourismZoneRepository->updateTourismZone($tourismZone->id,$tourismZoneDetails);
   Session::flash('success','Tourism Zone Updated Successfully');
   if(!is_null($request->iscompleted)) {
    $tourism_zone->freeEditing();
    return redirect()->Route('admin.tourism-zones.index');
}
return redirect()->Route('admin.tourism-zones.edit',$tourismZone->id);
}

public function bulk_delete(Request $request)
{
    if (!empty($request->ids)) {

        $tourismZoneIds = get_array_mapping(json_decode($request->ids));
        $this->tourismZoneRepository->deleteBulkTourismZone($tourismZoneIds);
        Session::flash('success', 'Tourism Zone Bulk Trashed Successfully');
    }
    return back();
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourismZone  $tourismZone
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourismZone $tourismZone)
    {
        if (!$tourismZone) {
         abort(404);

     }

     $this->tourismZoneRepository->deleteTourismZone($tourismZone->id);
     Session::flash('success','Tourism Zone Trashed Successfully');
     return redirect()->back();
 }

 public function trashed_tourismZones(TrashedTourismZoneDataTable $dataTable)
{

    $trashed_tourismZones = TourismZone::onlyTrashed()->get();
    $data['trashed_count'] = $trashed_tourismZones->count();
        //$data['trashed_tourismZones'] = $trashed_tourismZones;
    $data['title'] = 'Trash Tourism Zone List';
        // dump(TourismZone::onlyTrashed()->get());
        // dd( $data['trashed']);
    return $dataTable->render('admin.tourism-zones.trashed', $data);
}

public function restore_tourismZones(Request $request)
{
    $ids = [];
    if (!empty($request->ids)) {
       $ids =  get_array_mapping(json_decode($request->ids));

   }

   if (!empty($ids)) {
     TourismZone::whereIn('id',$ids)->withTrashed()->restore();
 }else{
   TourismZone::onlyTrashed()->restore();
}
Session::flash('success','Tourism Zone Restored Successfully');
return redirect()->back();
}

public function restore_tourismZone(Request $request,$id)
{
    $tourismZone = TourismZone::withTrashed()->find($id);
    if ($tourismZone == null)
    {
        abort(404);
    }

    $tourismZone->restore();
    Session::flash('success','Tourism Zone Restored Successfully');
    return redirect()->back();
}
public function bulk_force_delete(Request $request)
{


    if (!empty($request->fd_ids)) {

        $tourismZoneIds = get_array_mapping(json_decode($request->fd_ids));
        $this->tourismZoneRepository->forceBulkDeleteTourismZone($tourismZoneIds);
        Session::flash('success', 'Tourism Zone Bulk Permanent Deleted Successfully');
    }
    return back();
}

public function permanent_delete($id)
{
    $this->tourismZoneRepository->forceDeleteTourismZone($id);
    Session::flash('success','Tourism Zone Permanent Deleted Successfully');
    return back();
}
public function empty_trashed(Request $request)
{

    TourismZone::onlyTrashed()->forceDelete();
    Session::flash('success','Tourism Zone Empty Trashed Successfully');
    return redirect()->back();
}
}

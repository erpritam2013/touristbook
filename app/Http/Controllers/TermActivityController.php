<?php

namespace App\Http\Controllers;

use App\Interfaces\TermActivityRepositoryInterface;
use App\Models\Terms\TermActivity;
use App\Http\Requests\StoreTermActivityRequest;
use App\Http\Requests\UpdateTermActivityRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;

class TermActivityController extends Controller
{


    private TermActivityRepositoryInterface $termActivityRepository;

    public function __construct(TermActivityRepositoryInterface $termActivityRepository)
    {
        $this->termActivityRepository = $termActivityRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['term_activities'] = $this->termActivityRepository->getAllTermActivities();
        $data['title'] = 'Term Activity List';

        return view('admin.terms.term-activities.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Term Activity';
        //$data['term_activities'] = $this->termActivityRepository->getTermActivitiesByType();
        return view('admin.terms.term-activities.create',$data);
    }

     public function getTermActivitiesAjax(Request $request): JsonResponse 
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->termActivityRepository->getTermActivitiesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }

     public function changeStatus(Request $request): JsonResponse
    {
        $termActivityId = $request->id;
          $termActivityDetails = [
            'status' => $request->status,
        ];
        $this->termActivityRepository->updateTermActivity($termActivityId, $termActivityDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTermActivityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTermActivityRequest $request)
    {
         $termActivityDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(TermActivity::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'term_activity_type' => $request->term_activity_type,
            'description' => $request->description,
        ];
        $this->termActivityRepository->createTermActivity($termActivityDetails);
        Session::flash('success','Term Activity Created Successfully');
        return redirect()->Route('admin.terms.term-activities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TermActivity  $termActivity
     * @return \Illuminate\Http\Response
     */
    public function show(TermActivity $termActivity)
    {
        //$termActivityId = $termActivity->id;

        $data['term_activity'] = $termActivity;
        $data['title'] = 'Term Activity';

        if (empty($data['term_activity'])) {
            return back();
        }

        return view('admin.terms.term-activities.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermActivity  $termActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(TermActivity $termActivity)
    {
        $termActivityId = $termActivity->id;

        $data['term_activity'] = $termActivity;

        $data['title'] = 'Term Activity Edit';

        if (empty($data['term_activity'])) {
            return back();
        }
        $data['term_activities'] = $this->termActivityRepository->getTermActivitiesByType($data['term_activity']->term_activity_type,$termActivityId);
        return view('admin.terms.term-activities.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTermActivityRequest  $request
     * @param  \App\Models\TermActivity  $termActivity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTermActivityRequest $request, TermActivity $termActivity)
    {
         $termActivityId = $termActivity->id;
         
         $termActivityDetails = [
            'name' => $request->name,
            //'slug' => SlugService::createSlug(Post::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'term_activity_type' => $request->term_activity_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->termActivityRepository->updateTermActivity($termActivityId, $termActivityDetails);
         Session::flash('success','Term Activity Updated Successfully');
        return redirect()->Route('admin.terms.term-activities.edit',$termActivityId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermActivity  $termActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermActivity $termActivity)
    {
        $termActivityId = $termActivity->id;
        $this->termActivityRepository->deleteTermActivity($termActivityId);
         Session::flash('success','Term Activity Deleted Successfully');
        return back();
    }

    /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\TermActivity  $termActivity
     * @return \Illuminate\Http\Response
     */
    public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $termActivityIds = get_array_mapping(json_decode($request->ids));
        $this->termActivityRepository->deleteBulkTermActivity($termActivityIds);
         Session::flash('success','Term Activity Bulk Deleted Successfully');
        }
        return back();
    }
}

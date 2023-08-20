<?php

namespace App\Http\Controllers;
use App\Interfaces\StateRepositoryInterface;
use App\Interfaces\CountryRepositoryInterface;
use App\Models\Terms\State;
use App\Http\Requests\StoreStateRequest;
use App\Http\Requests\UpdateStateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;

class StateController extends Controller
{

      private StateRepositoryInterface $stateRepository;
      private CountryRepositoryInterface $countryRepository;

    public function __construct(StateRepositoryInterface $stateRepository,CountryRepositoryInterface $countryRepository)
    {
        $this->stateRepository = $stateRepository;
        $this->countryRepository = $countryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['states'] = $this->stateRepository->getAllStates();
        $data['title'] = 'State List';

        return view('admin.terms.states.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['title'] = 'Add State';
         $data['countries'] = $this->countryRepository->getCountiesList();
        return view('admin.terms.states.create',$data);
    }

     public function changeStatus(Request $request): JsonResponse
    {
        $StateId = $request->id;
          $stateDetails = [
            'status' => $request->status,
        ];
        $this->stateRepository->updateState($StateId, $stateDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStateRequest $request)
    {
        $StateDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(State::class, 'slug', $request->name),
            'parent_state' => (!empty($request->parent_state))?$request->parent_state:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'extra_data' => json_encode($request->extra_data),
            'country' => $request->country,
            'description' => $request->description,
        ];
        $this->stateRepository->createState($StateDetails);
        Session::flash('success','State Created Successfully');
        return redirect()->Route('admin.terms.states.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        $data['state'] = $state;
        $data['title'] = 'state';

        if (empty($data['state'])) {
            return back();
        }

        return view('admin.terms.states.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $StateId = $state->id;

        $data['state'] = $state;

        $data['title'] = 'State Edit';

        if (empty($data['state'])) {
            return back();
        }
        $data['states'] = $this->stateRepository->getActiveStatesList($StateId);
        $data['countries'] = $this->countryRepository->getCountiesList();
        return view('admin.terms.states.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStateRequest  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStateRequest $request, State $state)
    {
       
        $stateId = $state->id;
         $stateDetails = [
            'name' => $request->name,
            //'slug' => SlugService::createSlug(Post::class, 'slug', $request->name),
            'parent_state' => (!empty($request->parent_state))?$request->parent_state:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'extra_data' => json_encode($request->extra_data),
            'country' => $request->country,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->stateRepository->updateState($stateId, $stateDetails);
         Session::flash('success','state Updated Successfully');
        return redirect()->Route('admin.terms.states.edit',$stateId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $stateId = $state->id;
        $this->stateRepository->deleteState($stateId);
        Session::flash('success','State Deleted Successfully');
        return back();
    }

       /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */

     public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $stateIds = get_array_mapping(json_decode($request->ids));
        $this->stateRepository->deleteBulkState($stateIds);
         Session::flash('success','State Bulk Deleted Successfully');
        }
        return back();
    }
}

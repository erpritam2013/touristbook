<?php

namespace App\Http\Controllers;
use App\Interfaces\MeetingAndEventRepositoryInterface;
use App\Models\Terms\MeetingAndEvent;
use App\Http\Requests\StoreMeetingAndEventRequest;
use App\Http\Requests\UpdateMeetingAndEventRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\MeetingAndEventDataTable;
class MeetingAndEventController extends Controller
{

    private MeetingAndEventRepositoryInterface $MeetingAndEventRepository;

    public function __construct(MeetingAndEventRepositoryInterface $MeetingAndEventRepository)
    {
        $this->MeetingAndEventRepository = $MeetingAndEventRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MeetingAndEventDataTable $dataTable)
    {
        // $data['meeting_and_events'] = $this->MeetingAndEventRepository->getAllMeetingAndEvents();
        $data['meeting_and_events'] =MeetingAndEvent::count();
        $data['title'] = 'Meeting And Event List';

        return $dataTable->render('admin.terms.meeting-and-events.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Meeting And Event';
        //$data['meeting_and_events'] = $this->MeetingAndEventRepository->getMeetingAndEventsByType();
        return view('admin.terms.meeting-and-events.create',$data);
    }

     public function getMeetingAndEventsAjax(Request $request): JsonResponse 
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->MeetingAndEventRepository->getMeetingAndEventsByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $MeetingAndEventId = $request->id;
          $MeetingAndEventDetails = [
            'status' => $request->status,
        ];
        $this->MeetingAndEventRepository->updateMeetingAndEvent($MeetingAndEventId, $MeetingAndEventDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMeetingAndEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeetingAndEventRequest $request)
    {
         $MeetingAndEventDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(MeetingAndEvent::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'meeting_and_event_type' => $request->meeting_and_event_type,
            'description' => $request->description,
            'extra_data' => json_encode($request->extra_data),
        ];
        $this->MeetingAndEventRepository->createMeetingAndEvent($MeetingAndEventDetails);
        Session::flash('success','Meeting And Event Created Successfully');
        return redirect()->Route('admin.terms.meeting-and-events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MeetingAndEvent  $meetingAndEvent
     * @return \Illuminate\Http\Response
     */
    public function show(MeetingAndEvent $meetingAndEvent)
    {
       $data['meeting_and_event'] = $meetingAndEvent;
        $data['title'] = 'Meeting And Event';

        if (empty($data['meeting_and_event'])) {
            return back();
        }

        return view('admin.terms.meeting-and-events.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MeetingAndEvent  $meetingAndEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(MeetingAndEvent $meetingAndEvent)
    {
        $MeetingAndEventId = $meetingAndEvent->id;

        $data['meeting_and_event'] = $meetingAndEvent;

        $data['title'] = 'Meeting And Event Edit';

        if (empty($data['meeting_and_event'])) {
            return back();
        }
        $data['meeting_and_events'] = $this->MeetingAndEventRepository->getMeetingAndEventsByType($data['meeting_and_event']->meeting_and_event_type,$MeetingAndEventId);
        return view('admin.terms.meeting-and-events.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMeetingAndEventRequest  $request
     * @param  \App\Models\MeetingAndEvent  $meetingAndEvent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMeetingAndEventRequest $request, MeetingAndEvent $meetingAndEvent)
    {
        $MeetingAndEventId = $meetingAndEvent->id;
         
         $MeetingAndEventDetails = [
            'name' => $request->name,
             'slug' => (!empty($request->slug) && $meetingAndEvent->slug != $request->slug)?SlugService::createSlug(MeetingAndEvent::class, 'slug', $request->slug):$meetingAndEvent->slug,
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'meeting_and_event_type' => $request->meeting_and_event_type,
            'description' => $request->description,
            'extra_data' => json_encode($request->extra_data),
            'status' => $request->status,
        ];

        $this->MeetingAndEventRepository->updateMeetingAndEvent($MeetingAndEventId, $MeetingAndEventDetails);
         Session::flash('success','Meeting And Event Updated Successfully');
        return redirect()->Route('admin.terms.meeting-and-events.edit',$MeetingAndEventId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MeetingAndEvent  $meetingAndEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeetingAndEvent $meetingAndEvent)
    {
          $MeetingAndEventId = $meetingAndEvent->id;
        $this->MeetingAndEventRepository->deleteMeetingAndEvent($MeetingAndEventId);
         Session::flash('success','Meeting And Event Deleted Successfully');
        return back();
    }

     /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\MeetingAndEvent  $MeetingAndEvent
     * @return \Illuminate\Http\Response
     */

     public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $MeetingAndEventIds = get_array_mapping(json_decode($request->ids));
        $this->MeetingAndEventRepository->deleteBulkMeetingAndEvent($MeetingAndEventIds);
         Session::flash('success','Meeting And Event Bulk Deleted Successfully');
        }
        return back();
    }
}

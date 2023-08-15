<?php

namespace App\Http\Controllers;

use App\Models\Terms\MeetingAndEvent;
use App\Http\Requests\StoreMeetingAndEventRequest;
use App\Http\Requests\UpdateMeetingAndEventRequest;

class MeetingAndEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMeetingAndEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeetingAndEventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MeetingAndEvent  $meetingAndEvent
     * @return \Illuminate\Http\Response
     */
    public function show(MeetingAndEvent $meetingAndEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MeetingAndEvent  $meetingAndEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(MeetingAndEvent $meetingAndEvent)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MeetingAndEvent  $meetingAndEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeetingAndEvent $meetingAndEvent)
    {
        //
    }
}

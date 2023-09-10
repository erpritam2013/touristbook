<?php

namespace App\Http\Controllers;

use App\Models\ActivityLists;
use App\Http\Requests\StoreActivityListsRequest;
use App\Http\Requests\UpdateActivityListsRequest;

class ActivityListsController extends Controller
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
     * @param  \App\Http\Requests\StoreActivityListsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityListsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityLists  $activityLists
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityLists $activityLists)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityLists  $activityLists
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityLists $activityLists)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityLists  $activityLists
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityLists $activityLists)
    {
        //
    }
}

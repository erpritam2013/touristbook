<?php

namespace App\Http\Controllers;

use App\Models\ActivityPackage;
use App\Http\Requests\StoreActivityPackageRequest;
use App\Http\Requests\UpdateActivityPackageRequest;

class ActivityPackageController extends Controller
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
     * @param  \App\Http\Requests\StoreActivityPackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityPackageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityPackage  $activityPackage
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityPackage $activityPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityPackage  $activityPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityPackage $activityPackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivityPackageRequest  $request
     * @param  \App\Models\ActivityPackage  $activityPackage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityPackageRequest $request, ActivityPackage $activityPackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityPackage  $activityPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityPackage $activityPackage)
    {
        //
    }
}

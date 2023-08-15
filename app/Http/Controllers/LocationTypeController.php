<?php

namespace App\Http\Controllers;

use App\Models\Terms\LocationType;
use App\Http\Requests\StoreLocationTypeRequest;
use App\Http\Requests\UpdateLocationTypeRequest;

class LocationTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreLocationTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Terms\LocationType  $locationType
     * @return \Illuminate\Http\Response
     */
    public function show(LocationType $locationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Terms\LocationType  $locationType
     * @return \Illuminate\Http\Response
     */
    public function edit(LocationType $locationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationTypeRequest  $request
     * @param  \App\Models\Terms\LocationType  $locationType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationTypeRequest $request, LocationType $locationType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Terms\LocationType  $locationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationType $locationType)
    {
        //
    }
}

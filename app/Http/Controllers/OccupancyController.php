<?php

namespace App\Http\Controllers;

use App\Models\Terms\Occupancy;
use App\Http\Requests\StoreOccupancyRequest;
use App\Http\Requests\UpdateOccupancyRequest;

class OccupancyController extends Controller
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
     * @param  \App\Http\Requests\StoreOccupancyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOccupancyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function show(Occupancy $occupancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupancy $occupancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOccupancyRequest  $request
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOccupancyRequest $request, Occupancy $occupancy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupancy $occupancy)
    {
        //
    }
}

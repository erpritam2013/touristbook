<?php

namespace App\Http\Controllers;

use App\Models\CountryZone;
use App\Http\Requests\StoreCountryZoneRequest;
use App\Http\Requests\UpdateCountryZoneRequest;

class CountryZoneController extends Controller
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
     * @param  \App\Http\Requests\StoreCountryZoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryZoneRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CountryZone  $countryZone
     * @return \Illuminate\Http\Response
     */
    public function show(CountryZone $countryZone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CountryZone  $countryZone
     * @return \Illuminate\Http\Response
     */
    public function edit(CountryZone $countryZone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountryZoneRequest  $request
     * @param  \App\Models\CountryZone  $countryZone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryZoneRequest $request, CountryZone $countryZone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CountryZone  $countryZone
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountryZone $countryZone)
    {
        //
    }
}

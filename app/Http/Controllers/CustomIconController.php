<?php

namespace App\Http\Controllers;

use App\Models\CustomIcon;
use App\Http\Requests\StoreCustomIconRequest;
use App\Http\Requests\UpdateCustomIconRequest;

class CustomIconController extends Controller
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
     * @param  \App\Http\Requests\StoreCustomIconRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomIconRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomIcon  $customIcon
     * @return \Illuminate\Http\Response
     */
    public function show(CustomIcon $customIcon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomIcon  $customIcon
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomIcon $customIcon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomIconRequest  $request
     * @param  \App\Models\CustomIcon  $customIcon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomIconRequest $request, CustomIcon $customIcon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomIcon  $customIcon
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomIcon $customIcon)
    {
        //
    }
}

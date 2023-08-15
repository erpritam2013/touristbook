<?php

namespace App\Http\Controllers;

use App\Models\Terms\Accessible;
use App\Http\Requests\StoreAccessibleRequest;
use App\Http\Requests\UpdateAccessibleRequest;

class AccessibleController extends Controller
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
     * @param  \App\Http\Requests\StoreAccessibleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccessibleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accessible  $accessible
     * @return \Illuminate\Http\Response
     */
    public function show(Accessible $accessible)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accessible  $accessible
     * @return \Illuminate\Http\Response
     */
    public function edit(Accessible $accessible)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccessibleRequest  $request
     * @param  \App\Models\Accessible  $accessible
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccessibleRequest $request, Accessible $accessible)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accessible  $accessible
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accessible $accessible)
    {
        //
    }
}

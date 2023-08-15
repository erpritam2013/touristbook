<?php

namespace App\Http\Controllers;

use App\Models\Terms\DealsDiscount;
use App\Http\Requests\StoreDealsDiscountRequest;
use App\Http\Requests\UpdateDealsDiscountRequest;

class DealsDiscountController extends Controller
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
     * @param  \App\Http\Requests\StoreDealsDiscountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDealsDiscountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DealsDiscount  $dealsDiscount
     * @return \Illuminate\Http\Response
     */
    public function show(DealsDiscount $dealsDiscount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DealsDiscount  $dealsDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(DealsDiscount $dealsDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDealsDiscountRequest  $request
     * @param  \App\Models\DealsDiscount  $dealsDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDealsDiscountRequest $request, DealsDiscount $dealsDiscount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DealsDiscount  $dealsDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(DealsDiscount $dealsDiscount)
    {
        //
    }
}

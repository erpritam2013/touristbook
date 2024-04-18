<?php

namespace App\Repositories;

use App\Interfaces\AttractionRepositoryInterface;
use App\Models\Terms\Attraction;

class AttractionRepository implements AttractionRepositoryInterface 
{
    public function getAllAttractions()
    {
        return Attraction::orderBy('id','desc')->get();
    }
    public function getAttractionsByType($type=null,$a_id=null) 
    {
        return Attraction::where('attraction_type',$type)->where('id', '!=', $a_id)->get(['id','name']);
    }

    public function getAttractionById($attractionId) 
    {
        return Attraction::findOrFail($attractionId);
    }

    public function deleteAttraction($attractionId) 
    {
        Attraction::destroy($attractionId);
    }
    public function deleteBulkAttraction($attractionIds) 
    {
        Attraction::whereIn('id', $attractionIds)->delete();
    }

    public function createAttraction(array $attractionDetails) 
    {
        return Attraction::create($attractionDetails);
    }

    public function updateAttraction($attractionId, array $newDetails) 
    {
        return Attraction::whereId($attractionId)->update($newDetails);
    } 



    // Get all Active Attractions or by Type
    public function getActiveAttractionsList($type = null) {
        $AttractionBuilder = Attraction::orderBy('name','asc')->where('status', Attraction::ACTIVE);

        if($type)
            $AttractionBuilder->where('attraction_type',$type);

        return $AttractionBuilder->latest()->get(['id','name','parent_id']);
    }

    // Get Active Hotel Type Attractions
    public function getActiveHotelAttractionsList() {
        $type = Attraction::HOTEL_TYPE;
        return $this->getActiveAttractionsList($type);
    }
    // Get Active Hotel Type Attractions
    public function getActiveActivityAttractionsList() {
        $type = Attraction::ACTIVITY_TYPE;
        return $this->getActiveAttractionsList($type);
    }
}

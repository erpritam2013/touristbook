<?php

namespace App\Repositories;

use App\Interfaces\PlaceRepositoryInterface;
use App\Models\Terms\Place;

class PlaceRepository implements PlaceRepositoryInterface 
{
    public function getAllPlaces() 
    {
        return Place::all();
    }
    public function getPlacesByType($type=null,$p_id=null) 
    {
        return Place::where('place_type',$type)->where('id', '!=', $p_id)->get(['id','name']);
    }

    public function getPlaceById($placeId) 
    {
        return Place::findOrFail($placeId);
    }

    public function deletePlace($placeId) 
    {
        Place::destroy($placeId);
    }
    public function deleteBulkPlace($placeIds) 
    {
         Place::whereIn('id', $placeIds)->delete();
    }

    public function createPlace(array $placeDetails) 
    {
        return Place::create($placeDetails);
    }

    public function updatePlace($placeId, array $newDetails) 
    {
        return Place::whereId($placeId)->update($newDetails);
    } 

    // Get all Active Places or by Type
    public function getActivePlacesList($type = null) {
        $placeBuilder = Place::where('status', Place::ACTIVE);

        if($type)
            $placeBuilder->where('place_type',$type);

        return $placeBuilder->get(['id','name']);
    }

    // Get Active Hotel Type Places
    public function getActiveHotelPlacesList() {
        $type = Place::HOTEL_TYPE;
        return $this->getActivePlacesList($type);
    }
}

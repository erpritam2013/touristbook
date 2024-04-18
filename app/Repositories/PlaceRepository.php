<?php

namespace App\Repositories;

use App\Interfaces\PlaceRepositoryInterface;
use App\Models\Terms\Place;
use DataTables;
class PlaceRepository implements PlaceRepositoryInterface 
{
    public function getAllPlaces() 
    {
        return Place::orderBy('id','desc')->get();
    }
    public function getPlacesByType($type=null,$p_id=null) 
    {
        $placeTypeBuilder = [];

        $placeTypeBuilder = Place::where('status', Place::ACTIVE)->get(['id','name','parent_id']);
        if (!empty($type)){
        $placeTypeBuilder = Place::where('status', Place::ACTIVE)->where('place_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($p_id)){
        $placeTypeBuilder = Place::where('status', Place::ACTIVE)->where('id', '!=', $p_id)->where('parent_id', '!=', $p_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $placeTypeBuilder;
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
        $placeBuilder = Place::orderBy('name','asc')->where('status', Place::ACTIVE);

        if($type)
            $placeBuilder->where('place_type',$type);

           $places = $placeBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $places->toNested();

        return  $nestedResult;
    }

    // Get Active Hotel Type Places
    public function getActiveHotelPlacesList() {
        $type = Place::HOTEL_TYPE;
        // return $this->getActivePlacesList($type);
        return $this->getActivePlacesList();
    }
    // Get Active Loction Type Places
    public function getActiveLocationPlacesList() {
        $type = Place::LOCATION_TYPE;
        // return $this->getActivePlacesList($type);
        return $this->getActivePlacesList();
    }
}

<?php

namespace App\Interfaces;

interface PlaceRepositoryInterface 
{
    public function getAllPlaces();
    public function getPlaceById($placeId);
    public function deletePlace($placeId);
    public function deleteBulkPlace($placeIds);
    public function createPlace(array $placeDetails);
    public function updatePlace($placeId, array $newDetails);
    public function getPlacesByType(string $type);
}

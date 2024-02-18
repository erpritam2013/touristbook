<?php

namespace App\Interfaces;

interface AmenityRepositoryInterface 
{
    public function getAllAmenities();
    public function getAmenityById($amenityId);
    public function deleteAmenity($amenityId);
    public function deleteBulkAmenity($amenityIds);
    public function createAmenity(array $amenityDetails);
    public function updateAmenity($amenityId, array $newDetails);
    public function getAmenitiesByType(string $type);

    public function getActiveAmenitiesList($type);
    public function getActiveHotelAmenitiesList();
    public function getActiveHotelAmenitiesListFilter();
    
}
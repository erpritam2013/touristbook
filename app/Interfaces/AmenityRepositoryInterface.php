<?php

namespace App\Interfaces;

interface AmenityRepositoryInterface 
{
    public function getAllAmenities();
    public function getAmenityById($amenityId);
    public function deleteAmenity($amenityId);
    public function createAmenity(array $amenityDetails);
    public function updateAmenity($amenityId, array $newDetails);
    public function getAmenitiesByType(string $type);
}
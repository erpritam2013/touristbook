<?php

namespace App\Interfaces;

interface OccupancyRepositoryInterface 
{
    public function getAllOccupancies();
    public function getOccupancyById($OccupancyId);
    public function deleteOccupancy($OccupancyId);
    public function deleteBulkOccupancy($OccupancyIds);
    public function createOccupancy(array $OccupancyDetails);
    public function updateOccupancy($OccupancyId, array $newDetails);
    public function getOccupanciesByType(string $type);

    public function getActiveOccupanciesList($type);
    public function getActiveHotelOccupanciesList();
    
}
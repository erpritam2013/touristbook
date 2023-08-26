<?php

namespace App\Interfaces;

interface LocationRepositoryInterface
{
    public function getAllLocations();
    public function getLocationById($locationId);
    public function deleteLocation($locationId);
    public function createLocation(array $locationDetails);
    public function updateLocation($locationId, array $newDetails);
}
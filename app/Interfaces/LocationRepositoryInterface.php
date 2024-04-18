<?php

namespace App\Interfaces;

interface LocationRepositoryInterface
{
    public function getAllLocations();
    public function getLocationById($locationId);
     public function forceDeleteLocation($locationId);
    public function forceBulkDeleteLocation($locationId);
    public function deleteLocation($locationId);
    public function createLocation(array $locationDetails);
    public function updateLocation($locationId, array $newDetails);
    public function createLocationMeta(array $locationMetaDetails);
    public function updateLocationMeta($locationId, array $newLocationMetaDetails);
    public function deleteBulkLocation($locationId);
     public function getActiveLocationsList();
}
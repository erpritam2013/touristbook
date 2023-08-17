<?php

namespace App\Interfaces;

interface FacilityRepositoryInterface 
{
    public function getAllFacilities();
    public function getFacilityById($facilityId);
    public function deleteFacility($facilityId);
    public function deleteBulkFacility($facilityIds);
    public function createFacility(array $facilityDetails);
    public function updateFacility($facilityId, array $newDetails);
    public function getFacilitiesByType(string $type);
}

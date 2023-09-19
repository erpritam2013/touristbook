<?php

namespace App\Interfaces;

interface ActivityZoneRepositoryInterface
{
    public function getAllActivityZones();
    public function getActivityZoneById($activityZoneId);
    public function deleteActivityZone($activityZoneId);
    public function deleteBulkActivityZone($activityZoneId);
    public function createActivityZone(array $activityZoneDetails);
    public function updateActivityZone($activityZoneId, array $newDetails);
}
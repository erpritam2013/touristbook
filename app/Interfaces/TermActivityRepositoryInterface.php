<?php

namespace App\Interfaces;

interface TermActivityRepositoryInterface 
{
    public function getAllTermActivities();
    public function getTermActivityById($termActivityId);
    public function deleteTermActivity($termActivityId);
    public function deleteBulkTermActivity($termActivityIds);
    public function createTermActivity(array $termActivityDetails);
    public function updateTermActivity($termActivityId, array $newDetails);
    public function getTermActivitiesByType(string $type);

    public function getActiveTermActivitiesList($type);
    public function getActiveHotelTermActivitiesList();
}

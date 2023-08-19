<?php

namespace App\Interfaces;

interface AccessibleRepositoryInterface 
{
    public function getAllAccessibles();
    public function getAccessibleById($accessibleId);
    public function deleteAccessible($accessibleId);
    public function deleteBulkAccessible($accessibleIds);
    public function createAccessible(array $accessibleDetails);
    public function updateAccessible($accessibleId, array $newDetails);
    public function getAccessiblesByType(string $type);

    public function getActiveAccessiblesList($type);
    public function getActiveHotelAccessiblesList();
    
}
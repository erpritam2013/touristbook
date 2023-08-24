<?php

namespace App\Interfaces;

interface TypeRepositoryInterface 
{
    public function getAllTypes();
    public function getTypeById($typeId);
    public function deleteType($typeId);
    public function deleteBulkType($typeIds);
    public function createType(array $typeDetails);
    public function updateType($typeId, array $newDetails);
    public function getTypesByType(string $type);

    public function getActiveTypesList($type);
    public function getActiveHotelTypesList();
}

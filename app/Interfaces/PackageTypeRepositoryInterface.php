<?php

namespace App\Interfaces;

interface PackageTypeRepositoryInterface 
{
    public function getAllPackageTypes();
    public function getPackageTypeById($packageTypeId);
    public function deletePackageType($packageTypeId);
    public function deleteBulkPackageType($packageTypeIds);
    public function createPackageType(array $packageTypeDetails);
    public function updatePackageType($packageTypeId, array $newDetails);
    public function getPackageTypesByType(string $type);

    public function getActivePackageTypesList($type);
    
}
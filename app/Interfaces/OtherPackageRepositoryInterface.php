<?php

namespace App\Interfaces;

interface OtherPackageRepositoryInterface 
{
    public function getAllOtherPackages();
    public function getOtherPackageById($OtherPackageId);
    public function deleteOtherPackage($OtherPackageId);
    public function deleteBulkOtherPackage($OtherPackageIds);
    public function createOtherPackage(array $OtherPackageDetails);
    public function updateOtherPackage($OtherPackageId, array $newDetails);
    public function getOtherPackagesByType(string $type);

    public function getActiveOtherPackagesList($type);
    
}
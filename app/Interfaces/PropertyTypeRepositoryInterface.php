<?php

namespace App\Interfaces;

interface PropertyTypeRepositoryInterface 
{
    public function getAllPropertyTypes();
    public function getPropertyTypeById($propertyTypeId);
    public function deletePropertyType($propertyTypeId);
    public function deleteBulkPropertyType($propertyTypeIds);
    public function createPropertyType(array $propertyTypeDetails);
    public function updatePropertyType($propertyTypeId, array $newDetails);
    public function getPropertyTypesByType(string $type);

    public function getActivePropertyTypesList($type);
    public function getActiveHotelPropertyTypesList();
    public function getActiveHotelPropertyTypesListFilter();
    
}
<?php

namespace App\Repositories;

use App\Interfaces\PropertyTypeRepositoryInterface;
use App\Models\Terms\PropertyType;

class PropertyTypeRepository implements PropertyTypeRepositoryInterface 
{
    public function getAllPropertyTypes()
    {
        return PropertyType::all();
    }
    public function getPropertyTypesByType($type=null,$pt_id=null) 
    {
        return PropertyType::where('property_type_type',$type)->where('id', '!=', $pt_id)->get(['id','name']);
    }

    public function getPropertyTypeById($propertyTypeId) 
    {
        return PropertyType::findOrFail($propertyTypeId);
    }

    public function deletePropertyType($propertyTypeId) 
    {
        PropertyType::destroy($propertyTypeId);
    }
    public function deleteBulkPropertyType($propertyTypeIds) 
    {
        PropertyType::whereIn('id', $propertyTypeIds)->delete();
    }

    public function createPropertyType(array $propertyTypeDetails) 
    {
        return PropertyType::create($propertyTypeDetails);
    }

    public function updatePropertyType($propertyTypeId, array $newDetails) 
    {
        return PropertyType::whereId($propertyTypeId)->update($newDetails);
    } 



    // Get all Active PropertyTypes or by Type
    public function getActivePropertyTypesList($type = null) {
        $propertyTypeBuilder = PropertyType::where('status', PropertyType::ACTIVE);

        if($type)
            $propertyTypeBuilder->where('property_type_type',$type);

        return $propertyTypeBuilder->get(['id','name']);
    }

    // Get Active Hotel Type PropertyTypes
    public function getActiveHotelPropertyTypesList() {
        $type = PropertyType::HOTEL_TYPE;
        return $this->getActivePropertyTypesList($type);
    }
}

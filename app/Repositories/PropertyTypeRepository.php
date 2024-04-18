<?php

namespace App\Repositories;

use App\Interfaces\PropertyTypeRepositoryInterface;
use App\Models\Terms\PropertyType;
use App\Models\Setting;
use App\Models\Page;

class PropertyTypeRepository implements PropertyTypeRepositoryInterface 
{

     private $commanPropertyType = null;
    public function __construct()
    {
        $page_id = Setting::get_setting('hotel_list_page');
        if (!empty($page_id)) {   
        $page = Page::find($page_id);
          if (isset($page->extra_data['hotel_common_property_type'])) {
              $this->commanPropertyType = $page->extra_data['hotel_common_property_type'];
          }
        }

    }
    public function getAllPropertyTypes()
    {
        return PropertyType::orderBy('id','desc')->get();
    }
    public function getPropertyTypesByType($type=null,$pt_id=null) 
    {
                 $propertyTypeTypeBuilder = [];
        if (!empty($type)){
        $propertyTypeTypeBuilder = PropertyType::where('status', PropertyType::ACTIVE)->where('property_type_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($pt_id)){
        $propertyTypeTypeBuilder = PropertyType::where('status', PropertyType::ACTIVE)->where('id', '!=', $pt_id)->where('parent_id', '!=', $pt_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $propertyTypeTypeBuilder;
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

        $propertyTypeBuilder = PropertyType::orderBy('name','asc')->where('status', PropertyType::ACTIVE);

        if($type)
            $propertyTypeBuilder->where('property_type_type',$type);

         $property_types = $propertyTypeBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $property_types->toNested();

        return  $nestedResult;
    }
    public function getActiveHotelPropertyTypesListFilter($type = null) {

        if (!empty($this->commanPropertyType)) {
            
        $propertyTypeBuilder = PropertyType::orderBy('name','asc')->where('status', PropertyType::ACTIVE)->whereIn('id',$this->commanPropertyType);
        }else{

        $propertyTypeBuilder = PropertyType::orderBy('name','asc')->where('status', PropertyType::ACTIVE);
        }

        if($type)
            $propertyTypeBuilder->where('property_type_type',$type);

         $property_types = $propertyTypeBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $property_types->toNested();

        return  $nestedResult;
    }

    // Get Active Hotel Type PropertyTypes
    public function getActiveHotelPropertyTypesList() {
        $type = PropertyType::HOTEL_TYPE;
        return $this->getActivePropertyTypesList($type);
    }
}

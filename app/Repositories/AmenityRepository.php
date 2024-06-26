<?php

namespace App\Repositories;

use App\Interfaces\AmenityRepositoryInterface;
use App\Models\Terms\Amenity;
use App\Models\Setting;
use App\Models\Page;

class AmenityRepository implements AmenityRepositoryInterface 
{

    private $commanAmenities = null;
    public function __construct()
    {
        $page_id = Setting::get_setting('hotel_list_page');
        if (!empty($page_id)) {   
        $page = Page::find($page_id);
          if (isset($page->extra_data['hotel_commen_amenities'])) {
              $this->commanAmenities = $page->extra_data['hotel_commen_amenities'];
          }
        }

    }
    public function getAllAmenities()
    {
        return Amenity::orderBy('id','desc')->get();
    }
    public function getAmenitiesByType($type=null,$a_id=null) 
    {
        $amenityTypeBuilder = [];
        if (!empty($type)){
        $amenityTypeBuilder = Amenity::where('status', Amenity::ACTIVE)->where('amenity_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($a_id)){
        $amenityTypeBuilder = Amenity::where('status', Amenity::ACTIVE)->where('id', '!=', $a_id)->where('parent_id', '!=', $a_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $amenityTypeBuilder;
    }

    public function getAmenityById($amenityId) 
    {
        return Amenity::findOrFail($amenityId);
    }

    public function deleteAmenity($amenityId) 
    {
        Amenity::destroy($amenityId);
    }
    public function deleteBulkAmenity($amenityIds) 
    {
        Amenity::whereIn('id', $amenityIds)->delete();
    }

    public function createAmenity(array $amenityDetails) 
    {
        return Amenity::create($amenityDetails);
    }

    public function updateAmenity($amenityId, array $newDetails) 
    {
        return Amenity::whereId($amenityId)->update($newDetails);
    } 



    // Get all Active Amenities or by Type
    public function getActiveAmenitiesList($type = null) {
        
       

        $amenityBuilder = Amenity::orderBy('name','asc')->where('status', Amenity::ACTIVE);
        
        if($type)
            $amenityBuilder->where('amenity_type',$type);

        $amenities = $amenityBuilder->get(['id','name', 'parent_id']);
     
        $nestedResult = $amenities->toNested();
      
        return  $nestedResult;
    }

    public function getActiveHotelAmenitiesListFilter($type = null)
    {
        if (!empty($this->commanAmenities)) {
        $amenityBuilder = Amenity::orderBy('name','asc')->where('status', Amenity::ACTIVE)->whereIn('id',$this->commanAmenities);
        }else{

        $amenityBuilder = Amenity::orderBy('name','asc')->where('status', Amenity::ACTIVE);
        }


        if($type)
            $amenityBuilder->where('amenity_type',$type);

        $amenities = $amenityBuilder->get(['id','name', 'parent_id']);
     
        $nestedResult = $amenities->toNested();
      
        return  $nestedResult;
    }

    // Get Active Hotel Type Amenities
    public function getActiveHotelAmenitiesList() {
        $type = Amenity::HOTEL_TYPE;
        return $this->getActiveAmenitiesList($type);
    }
}

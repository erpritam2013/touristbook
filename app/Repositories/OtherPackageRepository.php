<?php

namespace App\Repositories;

use App\Interfaces\OtherPackageRepositoryInterface;
use App\Models\Terms\OtherPackage;

class OtherPackageRepository implements OtherPackageRepositoryInterface 
{
    public function getAllOtherPackages()
    {
        return OtherPackage::orderBy('id','desc')->get();
    }
    public function getOtherPackagesByType($type=null,$pt_id=null) 
    {
                 $otherPackageTypeBuilder = [];
        if (!empty($type)){
        $otherPackageTypeBuilder = OtherPackage::where('status', OtherPackage::ACTIVE)->where('other_package_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($pt_id)){
        $otherPackageTypeBuilder = OtherPackage::where('status', OtherPackage::ACTIVE)->where('id', '!=', $pt_id)->where('parent_id', '!=', $pt_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $otherPackageTypeBuilder;
    }

    public function getOtherPackageById($otherPackageId) 
    {
        return OtherPackage::findOrFail($otherPackageId);
    }

    public function deleteOtherPackage($otherPackageId) 
    {
        OtherPackage::destroy($otherPackageId);
    }
    public function deleteBulkOtherPackage($otherPackageIds) 
    {
        OtherPackage::whereIn('id', $otherPackageIds)->delete();
    }

    public function createOtherPackage(array $otherPackageDetails) 
    {
        return OtherPackage::create($otherPackageDetails);
    }

    public function updateOtherPackage($otherPackageId, array $newDetails) 
    {
        return OtherPackage::whereId($otherPackageId)->update($newDetails);
    } 



    // Get all Active OtherPackages or by Type
    public function getActiveOtherPackagesList($type = null) {
        $otherPackageBuilder = OtherPackage::where('status', OtherPackage::ACTIVE);

        if($type)
            $otherPackageBuilder->where('other_package_type',$type);

         $other_packages = $otherPackageBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $other_packages->toNested();

        return  $nestedResult;
    }

    // Get Active Tour Type Other Packages
    public function getActiveTourOtherPackagesList() {
        $type = OtherPackage::TOUR_TYPE;
        return $this->getActiveOtherPackagesList($type);
    }
}

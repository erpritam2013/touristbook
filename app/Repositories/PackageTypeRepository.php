<?php

namespace App\Repositories;

use App\Interfaces\PackageTypeRepositoryInterface;
use App\Models\Terms\PackageType;

class PackageTypeRepository implements PackageTypeRepositoryInterface 
{
    public function getAllPackageTypes()
    {
        return PackageType::orderBy('id','desc')->get();
    }
    public function getPackageTypesByType($type=null,$pt_id=null) 
    {
                 $packageTypeTypeBuilder = [];
        if (!empty($type)){
        $packageTypeTypeBuilder = PackageType::where('status', PackageType::ACTIVE)->where('package_type_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($pt_id)){
        $packageTypeTypeBuilder = PackageType::where('status', PackageType::ACTIVE)->where('id', '!=', $pt_id)->where('parent_id', '!=', $pt_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $packageTypeTypeBuilder;
    }

    public function getPackageTypeById($packageTypeId) 
    {
        return PackageType::findOrFail($packageTypeId);
    }

    public function deletePackageType($packageTypeId) 
    {
        PackageType::destroy($packageTypeId);
    }
    public function deleteBulkPackageType($packageTypeIds) 
    {
        PackageType::whereIn('id', $packageTypeIds)->delete();
    }

    public function createPackageType(array $PackageTypeDetails) 
    {
        return PackageType::create($PackageTypeDetails);
    }

    public function updatePackageType($packageTypeId, array $newDetails) 
    {
        return PackageType::whereId($packageTypeId)->update($newDetails);
    } 



    // Get all Active PackageTypes or by Type
    public function getActivePackageTypesList($type = null) {
        $packageTypeBuilder = PackageType::where('status', PackageType::ACTIVE);

        if($type)
            $packageTypeBuilder->where('package_type_type',$type);

         $package_types = $packageTypeBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $package_types->toNested();

        return  $nestedResult;
    }

    // Get Active Tour Type PackageTypes
    public function getActiveTourPackageTypesList() {
        $type = PackageType::TOUR_TYPE;
        return $this->getActivePackageTypesList($type);
    }
}

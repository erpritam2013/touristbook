<?php

namespace App\Repositories;

use App\Interfaces\AccessibleRepositoryInterface;
use App\Models\Terms\Accessible;

class AccessibleRepository implements AccessibleRepositoryInterface 
{
    public function getAllAccessibles()
    {
        return Accessible::orderBy('id','desc')->get();
    }
    public function getAccessiblesByType($type=null,$a_id=null) 
    {
        return Accessible::where('accessible_type',$type)->where('id', '!=', $a_id)->get(['id','name']);
    }

    public function getAccessibleById($accessibleId) 
    {
        return Accessible::findOrFail($accessibleId);
    }

    public function deleteAccessible($accessibleId) 
    {
        Accessible::destroy($accessibleId);
    }
    public function deleteBulkAccessible($accessibleIds) 
    {
        Accessible::whereIn('id', $accessibleIds)->delete();
    }

    public function createAccessible(array $accessibleDetails) 
    {
        return Accessible::create($accessibleDetails);
    }

    public function updateAccessible($accessibleId, array $newDetails) 
    {
        return Accessible::whereId($accessibleId)->update($newDetails);
    } 



    // Get all Active Accessibles or by Type
    public function getActiveAccessiblesList($type = null) {
        $accessibleBuilder = Accessible::orderBy('name','asc')->where('status', Accessible::ACTIVE);

        if($type)
            $accessibleBuilder->where('accessible_type',$type);

        $accessibles = $accessibleBuilder->get(['id','name','parent_id']);

        $nestedResult = $accessibles->toNested();
        return $nestedResult;
    }

    // Get Active Hotel Type Accessibles
    public function getActiveHotelAccessiblesList() {
        $type = Accessible::HOTEL_TYPE;
        return $this->getActiveAccessiblesList($type);
    }
}

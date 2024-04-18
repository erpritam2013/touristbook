<?php

namespace App\Repositories;

use App\Interfaces\TypeRepositoryInterface;
use App\Models\Terms\Type;

class TypeRepository implements TypeRepositoryInterface 
{
    public function getAllTypes() 
    {
        return Type::orderBy('id','desc')->get();
    }
    public function getTypesByType($type=null,$t_id=null) 
    {
         $typeTypeBuilder = [];
        if (!empty($type)){
        $typeTypeBuilder = Type::where('status', Type::ACTIVE)->where('type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($t_id)){
        $typeTypeBuilder = Type::where('status', Type::ACTIVE)->where('id', '!=', $t_id)->where('parent_id', '!=', $t_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $typeTypeBuilder;
    }

    public function getTypeById($typeId) 
    {
        return Type::findOrFail($typeId);
    }

    public function deleteType($typeId) 
    {
        Type::destroy($typeId);
    }
    public function deleteBulkType($typeIds) 
    {
         Type::whereIn('id', $typeIds)->delete();
    }

    public function createType(array $typeDetails) 
    {
        return Type::create($typeDetails);
    }

    public function updateType($typeId, array $newDetails) 
    {
        return Type::whereId($typeId)->update($newDetails);
    } 

    // Get all Active Types or by Type
    public function getActiveTypesList($type = null) {
        $typeBuilder = Type::orderBy('name','asc')->where('status', Type::ACTIVE);

        if($type)
            $typeBuilder->where('type',$type);

           $types = $typeBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $types->toNested();

        return  $nestedResult;
    }

    // Get Active Location Type Types
    public function getActiveLocationTypesList() {
        $type = Type::LOCATION_TYPE;
        return $this->getActiveTypesList($type);
    }
    // Get Active Location Type Types
    public function getActiveRoomTypesList() {
        $type = Type::ROOM_TYPE;
        return $this->getActiveTypesList($type);
    }
    // Get Active Location Type Types
    public function getActiveTourTypesList() {
        $type = Type::TOUR_TYPE;
        return $this->getActiveTypesList($type);
    }
}

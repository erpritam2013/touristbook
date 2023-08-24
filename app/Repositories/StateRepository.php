<?php

namespace App\Repositories;

use App\Interfaces\StateRepositoryInterface;
use App\Models\Terms\State;

class StateRepository implements StateRepositoryInterface 
{
    public function getAllStates()
    {
        return State::all();
    }
    
    public function getStateById($StateId) 
    {
        return State::findOrFail($StateId);
    }

    public function deleteState($StateId) 
    {
        State::destroy($StateId);
    }
    public function deleteBulkState($StateIds) 
    {
        State::whereIn('id', $StateIds)->delete();
    }

    public function createState(array $StateDetails) 
    {
        return State::create($StateDetails);
    }

    public function updateState($StateId, array $newDetails) 
    {
        return State::whereId($StateId)->update($newDetails);
    } 


    public function getParentStatesList($StateId=null)
    {
        $stateTypeBuilder = [];
        $stateTypeBuilder = State::where('status', State::ACTIVE)->get(['id','name','parent_id']);
        
        if (!empty($StateId)){
        $stateTypeBuilder = State::where('status', State::ACTIVE)->where('id', '!=', $StateId)->where('parent_id', '!=', $StateId)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $stateTypeBuilder;
    }
    // Get all Active States or by Type
    public function getActiveStatesList() {
        $stateBuilder = State::where('status', State::ACTIVE);

        $states = $stateBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $states->toNested();

        return  $nestedResult;
    }

   
}

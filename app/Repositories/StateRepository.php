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



    // Get all Active States or by Type
    public function getActiveStatesList($StateId=null) {
        $StateBuilder = State::where('status', State::ACTIVE);

        if($StateId)
            $StateBuilder->where('id','!=',$StateId);
        
        return $StateBuilder->get(['id','name']);
    }

   
}

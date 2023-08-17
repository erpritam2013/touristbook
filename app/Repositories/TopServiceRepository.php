<?php

namespace App\Repositories;

use App\Interfaces\TopServiceRepositoryInterface;
use App\Models\Terms\TopService;

class TopServiceRepository implements TopServiceRepositoryInterface 
{
    public function getAllTopServices() 
    {
        return TopService::all();
    }
    public function getTopServicesByType($type=null,$ts_id=null) 
    {
        return TopService::where('top_service_type',$type)->where('id', '!=', $ts_id)->get(['id','name']);
    }

    public function getTopServiceById($TopServiceId) 
    {
        return TopService::findOrFail($TopServiceId);
    }

    public function deleteTopService($TopServiceId) 
    {
        TopService::destroy($TopServiceId);
    }
    public function deleteBulkTopService($TopServiceIds) 
    {
        TopService::whereIn('id', $TopServiceIds)->delete();
    }

    public function createTopService(array $TopServiceDetails) 
    {
        return TopService::create($TopServiceDetails);
    }

    public function updateTopService($TopServiceId, array $newDetails) 
    {
        return TopService::whereId($TopServiceId)->update($newDetails);
    } 
}

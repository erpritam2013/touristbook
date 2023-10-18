<?php

namespace App\Repositories;

use App\Interfaces\TermActivityListRepositoryInterface;
use App\Models\Terms\TermActivityList;

class TermActivityListRepository implements TermActivityListRepositoryInterface
{

    public function getAllTermActivityLists()
    {
        return TermActivityList::orderBy('id','desc')->get();
    }
    public function getTermActivityListsByType($type=null,$tal_id=null) 
    {
        return TermActivityList::where('id', '!=', $tal_id)->get(['id','name','parent']);
        // return TermActivityList::where('term_activity_list_type',$type)->where('id', '!=', $tal_id)->get(['id','name']);
    }

    public function getTermActivityListById($termActivityListId) 
    {
        return TermActivityList::findOrFail($termActivityListId);
    }

    public function deleteTermActivityList($termActivityListId) 
    {
        TermActivityList::destroy($termActivityListId);
    }
    public function deleteBulkTermActivityList($termActivityListIds) 
    {
        TermActivityList::whereIn('id', $termActivityListIds)->delete();
    }

    public function createTermActivityList(array $termActivityListDetails) 
    {
        return TermActivityList::create($termActivityListDetails);
    }

    public function updateTermActivityList($termActivityListId, array $newDetails) 
    {
        return TermActivityList::whereId($termActivityListId)->update($newDetails);
    } 


    // Get all Active TermActivityLists or by Type
    public function getActiveTermActivityList($type = null) {
        $termActivityListBuilder = TermActivityList::orderBy('name','asc')->where('status', TermActivityList::ACTIVE);

        if($type)
           $termActivityListBuilder->where('term_activity_list_type',$type);

        return $termActivityListBuilder->get(['id','name','parent']);
    }

    // Get Active Hotel Type TermActivityLists
    public function getActiveActivityTermActivityList() {
        $type = TermActivityList::ACTIVITY_TYPE;
        return $this->getActiveTermActivityList($type);
    }

}

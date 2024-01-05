<?php

namespace App\Repositories;

use App\Interfaces\TermActivityRepositoryInterface;
use App\Models\Terms\TermActivity;
use App\Models\Setting;
use App\Models\Page;
class TermActivityRepository implements TermActivityRepositoryInterface 
{

      private $commanTermActivity = null;
    public function __construct()
    {
        $page_id = Setting::get_setting('hotel_list_page');
        if (!empty($page_id)) {   
        $page = Page::find($page_id);
          if (isset($page->extra_data['hotel_common_activities'])) {
              $this->commanTermActivity = $page->extra_data['hotel_common_activities'];
          }
        }

    }
    public function getAllTermActivities() 
    {
        return TermActivity::orderBy('id','desc')->get();
    }
    public function getTermActivitiesByType($type=null,$ta_id=null) 
    {
               $termActivityTypeBuilder = [];
        if (!empty($type)){
        $termActivityTypeBuilder = TermActivity::where('status', TermActivity::ACTIVE)->where('term_activity_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($ta_id)){
        $termActivityTypeBuilder = TermActivity::where('status', TermActivity::ACTIVE)->where('id', '!=', $ta_id)->where('parent_id', '!=', $ta_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $termActivityTypeBuilder;
    }

    public function getTermActivityById($termActivityId) 
    {
        return TermActivity::findOrFail($termActivityId);
    }

    public function deleteTermActivity($termActivityId) 
    {
        TermActivity::destroy($termActivityId);
    }
    public function deleteBulkTermActivity($termActivityIds) 
    {
        TermActivity::whereIn('id', $termActivityIds)->delete();
    }

    public function createTermActivity(array $termActivityDetails) 
    {
        return TermActivity::create($termActivityDetails);
    }

    public function updateTermActivity($termActivityId, array $newDetails) 
    {
        return TermActivity::whereId($termActivityId)->update($newDetails);
    } 


    // Get all Active Top Services or by Type
    public function getActiveTermActivitiesList($type = null) {
        
        if (!empty($this->commanTermActivity)) {
           
        $termActivityBuilder = TermActivity::orderBy('name','asc')->where('status', TermActivity::ACTIVE)->whereIn('id',$this->commanTermActivity);
        }else{
        $termActivityBuilder = TermActivity::orderBy('name','asc')->where('status', TermActivity::ACTIVE);

        }

        if($type)
            $termActivityBuilder->where('term_activity_type',$type);

         $top_services = $termActivityBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $top_services->toNested();

        return  $nestedResult;
    }

    // Get Active Hotel Type Medicare Assistances
    public function getActiveHotelTermActivitiesList() {
        $type = TermActivity::HOTEL_TYPE;
        return $this->getActiveTermActivitiesList($type);
    }
}

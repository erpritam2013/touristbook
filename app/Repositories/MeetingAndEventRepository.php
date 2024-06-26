<?php

namespace App\Repositories;

use App\Interfaces\MeetingAndEventRepositoryInterface;
use App\Models\Terms\MeetingAndEvent;
use App\Models\Setting;
use App\Models\Page;
class MeetingAndEventRepository implements MeetingAndEventRepositoryInterface 
{

     private $commanMeetingAndEvent = null;
    public function __construct()
    {
        $page_id = Setting::get_setting('hotel_list_page');
        if (!empty($page_id)) {   
        $page = Page::find($page_id);
          if (isset($page->extra_data['hotel_common_meetings_and_events'])) {
              $this->commanMeetingAndEvent = $page->extra_data['hotel_common_meetings_and_events'];
          }
        }

    }
    public function getAllMeetingAndEvents()
    {
        return MeetingAndEvent::get();
    }
    public function getMeetingAndEventsByType($type=null,$mae_id=null) 
    {
        $meetingAndEventTypeBuilder = [];
        if (!empty($type)){
        $meetingAndEventTypeBuilder = MeetingAndEvent::where('status', MeetingAndEvent::ACTIVE)->where('meeting_and_event_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($mae_id)){
        $meetingAndEventTypeBuilder = MeetingAndEvent::where('status', MeetingAndEvent::ACTIVE)->where('id', '!=', $mae_id)->where('parent_id', '!=', $mae_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $meetingAndEventTypeBuilder;
    }

    public function getMeetingAndEventById($MeetingAndEventId) 
    {
        return MeetingAndEvent::findOrFail($MeetingAndEventId);
    }

    public function deleteMeetingAndEvent($MeetingAndEventId) 
    {
        MeetingAndEvent::destroy($MeetingAndEventId);
    }
    public function deleteBulkMeetingAndEvent($MeetingAndEventIds) 
    {
        MeetingAndEvent::whereIn('id', $MeetingAndEventIds)->delete();
    }

    public function createMeetingAndEvent(array $MeetingAndEventDetails) 
    {
        return MeetingAndEvent::create($MeetingAndEventDetails);
    }

    public function updateMeetingAndEvent($MeetingAndEventId, array $newDetails) 
    {
        return MeetingAndEvent::whereId($MeetingAndEventId)->update($newDetails);
    } 



    // Get all Active Meeting And Events or by Type
    public function getActiveMeetingAndEventsList($type = null) {
       

        $meetingAndEventBuilder = MeetingAndEvent::orderBy('name','asc')->where('status', MeetingAndEvent::ACTIVE);
        

        if($type)
            $meetingAndEventBuilder->where('meeting_and_event_type',$type);

        $meeting_and_events = $meetingAndEventBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $meeting_and_events->toNested();

        return  $nestedResult;
    }
    public function getActiveHotelMeetingAndEventsListFilter($type = null) {
        if (!empty($this->commanMeetingAndEvent)) {
        $meetingAndEventBuilder = MeetingAndEvent::orderBy('name','asc')->where('status', MeetingAndEvent::ACTIVE)->whereIn('id',$this->commanMeetingAndEvent);
        }else{

        $meetingAndEventBuilder = MeetingAndEvent::orderBy('name','asc')->where('status', MeetingAndEvent::ACTIVE);
        }

        if($type)
            $meetingAndEventBuilder->where('meeting_and_event_type',$type);

        $meeting_and_events = $meetingAndEventBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $meeting_and_events->toNested();

        return  $nestedResult;
    }

    // Get Active Hotel Type Meeting And Events
    public function getActiveHotelMeetingAndEventsList() {
        $type = MeetingAndEvent::HOTEL_TYPE;
        return $this->getActiveMeetingAndEventsList($type);
    }
}

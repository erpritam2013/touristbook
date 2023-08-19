<?php

namespace App\Repositories;

use App\Interfaces\MeetingAndEventRepositoryInterface;
use App\Models\Terms\MeetingAndEvent;

class MeetingAndEventRepository implements MeetingAndEventRepositoryInterface 
{
    public function getAllMeetingAndEvents()
    {
        return MeetingAndEvent::all();
    }
    public function getMeetingAndEventsByType($type=null,$mae_id=null) 
    {
        return MeetingAndEvent::where('meeting_and_event_type',$type)->where('id', '!=', $mae_id)->get(['id','name']);
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
        $meetingAndEventBuilder = MeetingAndEvent::where('status', MeetingAndEvent::ACTIVE);

        if($type)
            $meetingAndEventBuilder->where('meeting_and_event_type',$type);

        return $meetingAndEventBuilder->get(['id','name']);
    }

    // Get Active Hotel Type Meeting And Events
    public function getActiveHotelMeetingAndEventsList() {
        $type = MeetingAndEvent::HOTEL_TYPE;
        return $this->getActiveMeetingAndEventsList($type);
    }
}

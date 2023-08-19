<?php

namespace App\Interfaces;

interface MeetingAndEventRepositoryInterface 
{
    public function getAllMeetingAndEvents();
    public function getMeetingAndEventById($MeetingAndEventId);
    public function deleteMeetingAndEvent($MeetingAndEventId);
    public function deleteBulkMeetingAndEvent($MeetingAndEventIds);
    public function createMeetingAndEvent(array $MeetingAndEventDetails);
    public function updateMeetingAndEvent($MeetingAndEventId, array $newDetails);
    public function getMeetingAndEventsByType(string $type);

    public function getActiveMeetingAndEventsList($type);
    public function getActiveHotelMeetingAndEventsList();
    
}
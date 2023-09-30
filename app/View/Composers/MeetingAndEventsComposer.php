<?php

namespace App\View\Composers;

use App\Interfaces\MeetingAndEventRepositoryInterface;
use App\Models\Terms\MeetingAndEvent;
use Illuminate\View\View;

class MeetingAndEventsComposer
{

    public function __construct(private MeetingAndEventRepositoryInterface $meetingAndEventsRepository) {}
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('filterMeetingEvents', $this->meetingAndEventsRepository->getActiveMeetingAndEventsList(MeetingAndEvent::HOTEL_TYPE));
    }
}

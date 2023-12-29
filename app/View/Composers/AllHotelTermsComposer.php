<?php

namespace App\View\Composers;

use App\Interfaces\PropertyTypeRepositoryInterface;
use App\Interfaces\AmenityRepositoryInterface;
use App\Interfaces\MedicareAssistanceRepositoryInterface;
use App\Interfaces\MeetingAndEventRepositoryInterface;
use App\Interfaces\DealsDiscountRepositoryInterface;
use App\Interfaces\TermActivityRepositoryInterface;

use Illuminate\View\View;

class AllHotelTermsComposer
{

    public function __construct(
    
        private MedicareAssistanceRepositoryInterface $medicareAssistanceRepository,
        private PropertyTypeRepositoryInterface $propertyTypeRepository,
        private MeetingAndEventRepositoryInterface $meetingAndEventRepository,
        private DealsDiscountRepositoryInterface $dealDiscountRepository,
        private TermActivityRepositoryInterface $termActivityRepository,
        private AmenityRepositoryInterface $amenityRepository
    ) {}
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {

        $view->with('commanAmenity', $this->amenityRepository->getActiveAmenitiesList('Hotel'));
        $view->with('commanPropertyType', $this->propertyTypeRepository->getActivePropertyTypesList('Hotel'));
        $view->with('commanMedicareAssistances', $this->medicareAssistanceRepository->getActiveMedicareAssistancesList('Hotel'));

        $view->with('commanMeetingAndEvent', $this->meetingAndEventRepository->getActiveMeetingAndEventsList('Hotel'));

        $view->with('commanDealsDiscount', $this->dealDiscountRepository->getActiveDealsDiscountsList('Hotel'));
        
        $view->with('commanTermActivity', $this->termActivityRepository->getActiveTermActivitiesList('Hotel'));


    }
}

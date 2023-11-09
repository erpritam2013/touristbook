<?php

namespace App\View\Composers;

use App\Interfaces\TypeRepositoryInterface;
use App\Models\Terms\Type;
use Illuminate\View\View;

class TypesComposer
{

    public function __construct(private TypeRepositoryInterface $typeRepository) {}
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
      
      if ($view->post_type == 'Hotel') {
         
        $view->with('filterTypes', $this->typeRepository->getActiveTypesList(Type::HOTEL_TYPE));
    }
    if ($view->post_type == 'Location') {
     
        $view->with('filterTypes', $this->typeRepository->getActiveTypesList(Type::LOCATION_TYPE));
    }
    if ($view->post_type == 'Tour') {
     
        $view->with('filterTypes', $this->typeRepository->getActiveTypesList(Type::TOUR_TYPE));
    }
    if ($view->post_type == 'Room') {
     
        $view->with('filterTypes', $this->typeRepository->getActiveTypesList(Type::ROOM_TYPE));
    }
}
}

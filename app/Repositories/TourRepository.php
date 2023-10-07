<?php

namespace App\Repositories;

use App\Interfaces\TourRepositoryInterface;
use App\Models\Tour;

class TourRepository implements TourRepositoryInterface
{
    public function getAllTours()
    {
        return Tour::orderBy('id','desc')->get();
    }
    public function getTourById($tourId)
    {
        return Tour::findOrFail($tourId);
    }
    public function deleteTour($tourId)
    {
        Tour::destroy($tourId);
    }

    public function deleteBulkTour($tourId)
    {
         Tour::whereIn('id', $tourId)->delete();
    }
    public function createTour(array $tourDetails)
    {
        return Tour::create($tourDetails);
    }
    public function updateTour($tourId, array $newDetails)
    {
        return Tour::whereId($tourId)->update($newDetails);
    }

}

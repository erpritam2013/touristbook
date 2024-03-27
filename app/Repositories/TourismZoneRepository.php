<?php

namespace App\Repositories;

use App\Interfaces\TourismZoneRepositoryInterface;
use App\Models\TourismZone;

class TourismZoneRepository implements TourismZoneRepositoryInterface
{
    public function getAllTourismZones()
    {
        return TourismZone::orderBy('id','desc')->get();
    }
    public function getTourismZoneById($tourismZoneId)
    {
        return TourismZone::findOrFail($tourismZoneId);
    }
    public function getTourismZoneByCountry($country)
    {
        return TourismZone::where('country',$country)->get(['id','title']);
    }
      public function forceDeleteTourismZone($tourismZoneId)
    {
         TourismZone::onlyTrashed()->find($tourismZoneId)->forceDelete();
    }
    public function forceBulkDeleteTourismZones($tourismZoneId)
    {
         TourismZone::onlyTrashed()->whereIn('id', $tourismZoneId)->forceDelete();
    }
    public function deleteTourismZone($tourismZoneId)
    {
        TourismZone::destroy($tourismZoneId);
    }

    public function deleteBulkTourismZone($tourismZoneId)
    {
         TourismZone::whereIn('id', $tourismZoneId)->delete();
    }
    public function createTourismZone(array $tourismZoneDetails)
    {
        return TourismZone::create($tourismZoneDetails);
    }
    public function updateTourismZone($tourismZoneId, array $newDetails)
    {
        return TourismZone::whereId($tourismZoneId)->update($newDetails);
    }

}

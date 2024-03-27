<?php

namespace App\Interfaces;

interface TourismZoneRepositoryInterface
{
    public function getAllTourismZones();
    public function getTourismZoneById($tourismZoneId);
    public function forceDeleteTourismZone($tourismZoneId);
    public function forceBulkDeleteTourismZones($tourismZoneId);
    public function deleteTourismZone($tourismZoneId);
    public function deleteBulkTourismZone($tourismZoneId);
    public function createTourismZone(array $tourismZoneDetails);
    public function updateTourismZone($tourismZoneId, array $newDetails);
    public function getTourismZoneByCountry($country);
}
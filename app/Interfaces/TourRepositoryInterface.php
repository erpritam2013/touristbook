<?php

namespace App\Interfaces;

interface TourRepositoryInterface
{
    public function getAllTours();
    public function getTourById($tourId);
    public function deleteTour($tourId);
    public function deleteBulkTour($tourId);
    public function createTour(array $tourDetails);
    public function updateTour($tourId, array $newDetails);
}
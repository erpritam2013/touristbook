<?php

namespace App\Interfaces;

interface HotelRepositoryInterface
{
    public function getAllHotels();
    public function getHotelById($hotelId);
    public function forceDeleteHotel($hotelId);
    public function forceBulkDeleteHotel($hotelId);
    public function deleteHotel($hotelId);
    public function deleteBulkHotel($hotelId);
    public function createHotel(array $hotelDetails);
    public function updateHotel($hotelId, array $newDetails);
    public function getActiveHotelList();
}
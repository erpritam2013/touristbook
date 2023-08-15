<?php

namespace App\Repositories;

use App\Interfaces\HotelRepositoryInterface;
use App\Models\Hotel;

class HotelRepository implements HotelRepositoryInterface
{
    public function getAllHotels()
    {
        return Hotel::all();
    }
    public function getHotelById($hotelId)
    {
        return Hotel::findOrFail($hotelId);
    }
    public function deleteHotel($hotelId)
    {
        Hotel::destroy($hotelId);
    }
    public function createHotel(array $hotelDetails)
    {
        return Hotel::create($hotelDetails);
    }
    public function updateHotel($hotelId, array $newDetails)
    {
        return Hotel::whereId($hotelId)->update($newDetails);
    }
    
}
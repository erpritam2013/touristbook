<?php

namespace App\Repositories;

use App\Interfaces\HotelRepositoryInterface;
use App\Models\Hotel;

class HotelRepository implements HotelRepositoryInterface
{
    public function getAllHotels()
    {
        return Hotel::orderBy('id','desc')->get();
    }
    public function getHotelById($hotelId)
    {
        return Hotel::findOrFail($hotelId);
    }

     public function forceDeleteHotel($hotelId)
    {
         Hotel::onlyTrashed()->find($hotelId)->forceDelete();
    }
    public function forceBulkDeleteHotel($hotelId)
    {
         Hotel::onlyTrashed()->whereIn('id', $hotelId)->forceDelete();
    }
    public function deleteHotel($hotelId)
    {
        Hotel::destroy($hotelId);
    }

    public function deleteBulkHotel($hotelId)
    {
         Hotel::whereIn('id', $hotelId)->delete();
    }
    public function createHotel(array $hotelDetails)
    {
        return Hotel::create($hotelDetails);
    }
    public function updateHotel($hotelId, array $newDetails)
    {
        return Hotel::whereId($hotelId)->update($newDetails);
    }

    public function getActiveHotelList()
    {
        $typeBuilder = Hotel::where('status', Hotel::ACTIVE)->get(['id','name']);

        return  $typeBuilder;
    }

}

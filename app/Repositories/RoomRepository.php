<?php

namespace App\Repositories;

use App\Interfaces\RoomRepositoryInterface;
use App\Models\Room;

class RoomRepository implements RoomRepositoryInterface
{
    public function getAllRooms()
    {
        return Room::orderBy('id','desc')->get();
    }
    public function getRoomById($roomId)
    {
        return Room::findOrFail($roomId);
    }

      public function forceDeleteRoom($roomId)
    {
         Room::onlyTrashed()->find($roomId)->forceDelete();
    }
    public function forceBulkDeleteRoom($roomId)
    {
         Room::onlyTrashed()->whereIn('id', $roomId)->forceDelete();
    }
    public function deleteRoom($roomId)
    {
        Room::destroy($roomId);
    }

    public function deleteBulkRoom($roomId)
    {
         Room::whereIn('id', $roomId)->delete();
    }
    public function createRoom(array $roomDetails)
    {
        return Room::create($roomDetails);
    }
    public function updateRoom($roomId, array $newDetails)
    {
        return Room::whereId($roomId)->update($newDetails);
    }

}

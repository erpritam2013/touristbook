<?php

namespace App\Interfaces;

interface RoomRepositoryInterface
{
    public function getAllRooms();
    public function getRoomById($roomId);
    public function deleteRoom($roomId);
    public function deleteBulkRoom($roomId);
    public function createRoom(array $roomDetails);
    public function updateRoom($roomId, array $newDetails);
}
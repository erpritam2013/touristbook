<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById($userId);
    public function deleteUser($userId);
    public function deleteBulkUser($userIds);
    public function createUser(array $userDetails);
    public function updateUser($userId, array $newDetails);
    public function getUserByType(string $type);

    public function getActiveUsersList();
}

<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::orderBy('id','desc')->get();
    }
    public function getUserByType($type=null,$user_id = null)
    {
        $userQuery = User::where('is_active', User::ACTIVE);
        if (!empty($type)){
            $userQuery->where('user_type', $type);
        }
        if (!empty($user_id)){
            $userQuery->where('id', '!=', $user_id);
        }

       return $userQuery->get(['id','name','email']);;
    }

    public function getUserById($user_id)
    {
        return User::findOrFail($user_id);
    }

    public function deleteUser($user_id)
    {
        User::destroy($user_id);
    }
    public function deleteBulkUser($userIds)
    {
         User::whereIn('id', $userIds)->delete();
    }

    public function createUser(array $userDetails)
    {
        if(isset($userDetails['password']) && !empty($userDetails['password'])){
            $userDetails['password'] = Hash::make($userDetails['password']);
        }
        return User::create($userDetails);
    }

    public function updateUser($user_id, array $newDetails)
    {
        if(isset($newDetails['password']) && !empty($newDetails['password'])){
            $newDetails['password'] = Hash::make($newDetails['password']);
        }else {
            unset($newDetails['password']);
        }
        return User::whereId($user_id)->update($newDetails);
    }


    // Get all Active User or by Type
    public function getActiveUsersList($type = null) {
        $userQuery = User::where('is_active', User::ACTIVE);

        $users = $userQuery->get(['id','name', 'email']);

        return  $users;
    }
}

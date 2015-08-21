<?php

namespace App\Repositories;

use App\User;

class UserRepository
{

    /**
     * Given an array of formatted user data,
     * return a valid user model
     *
     * @param array $userData
     * @return static
     */
    public function findByEmailOrCreate($userData)
    {
        //find user by email
        $user = User::firstOrNew(['email' => $userData['email']]);

        //save all new data to the record
        $user->save($userData);

        return $user;
    }
}

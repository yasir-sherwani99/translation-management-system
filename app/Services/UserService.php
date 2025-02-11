<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function store($data)
    {
        return User::create($data);
    }
}
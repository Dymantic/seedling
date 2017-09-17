<?php


namespace Tests;


use App\User;

trait MakesModels
{
    public function createUser($attributes = [], $hash = false) : User
    {
        $defaults = [
            'name'                  => 'Test Name',
            'email'                 => 'test@example.com',
            'password'              => 'password',
            'superadmin'            => true
        ];

        $user_data = array_merge($defaults, $attributes);

        if($hash) {
            $user_data['password'] = bcrypt($user_data['password']);
        }

        return User::create($user_data);
    }
}
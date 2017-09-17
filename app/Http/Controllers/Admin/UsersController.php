<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function store()
    {
        request()->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email',
            'password' => 'min:8|confirmed'
        ]);
        User::register(request()->only('name', 'email', 'password', 'superadmin'));
    }


    public function update(User $user)
    {
        request()->validate([
            'name'  => 'required',
            'email' => 'required|email'
        ]);
        $user->update(request()->only('name', 'email'));

        return $user->fresh()->toJsonableArray();
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}

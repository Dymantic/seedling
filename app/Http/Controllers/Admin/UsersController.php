<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all()->map->toJsonableArray();
        return view('admin.users.index', ['users' => $users]);
    }

    public function store()
    {
        $user_data = collect(request()->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email',
            'password' => 'min:8|confirmed',
            'superadmin' => ''
        ]))->reject(function($value) {
            return is_null($value);
        })->all();

        User::register($user_data);
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

<?php

namespace App\Http\Controllers\Admin\Services;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return User::all()->map->toJsonableArray();
    }
}

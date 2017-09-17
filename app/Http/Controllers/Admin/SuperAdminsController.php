<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuperAdminsController extends Controller
{
    public function store()
    {
        User::findOrFail(request('user_id'))->promoteToSuperAdmin();
    }

    public function delete(User $user)
    {
        $user->demoteToRegularUser();
    }
}

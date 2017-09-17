<?php

namespace App\Http\Controllers\Admin;

use App\Rules\MatchUserPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPasswordController extends Controller
{
    public function update()
    {
        request()->validate([
            'current_password' => new MatchUserPassword,
            'password' => 'min:8|confirmed'
        ]);
        auth()->user()->resetPassword(request('password'));
    }
}

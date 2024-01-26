<?php

namespace App\Http\Controllers;

use App\Models\User;

class PublicUserProfile extends Controller
{
    public function show(User $user)
    {
        return view('show-user-public-profile', ['user' => $user]);
    }

    public function showNew(User $user)
    {
        return view('create-wish', ['user' => $user]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Feedback;


class DashboardController extends Controller
{
    public function show()
    {
        return view('dashboard');
    }

    public function sentWishes()
    {
        return view('sent');
    }

    public function showWish(Feedback $wish)
    {
        return view('show-wish', ['wish' => $wish]);
    }
}

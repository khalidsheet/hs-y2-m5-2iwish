<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicUserProfile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(config('fortify.home'));
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/sent', [DashboardController::class, 'sentWishes'])->name('sent');
    Route::get('/show-wish/{wish}', [DashboardController::class, 'showWish'])->name('show-wish');

    Route::group(['prefix' => '/u', 'as' => 'user.'], function () {
        Route::get('/{user:username}', [PublicUserProfile::class, 'show'])->name('public-profile');
        Route::get('/{user:username}/new', [PublicUserProfile::class, 'showNew'])->name('public-profile.new');
    });
});

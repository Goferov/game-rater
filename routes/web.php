<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\Home\MainPageController;
use App\Http\Controllers\User\ShowAddressController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::group(['middleware' => ['auth']], function (){
    Route::get('/', MainPageController::class)
        ->name('home.mainPage');

    Route::get('users', [UserController::class, 'list'])
        ->name('get.users');

    Route::get('users/{userId}', [UserController::class, 'show'])
        ->name('get.user.show');

    Route::get('users/{id}/address', ShowAddressController::class)
        ->where(['id' => '[0-9]+'])
        ->name('get.users.address');

    Route::get('games/dashboard', [GameController::class, 'dashboard'])
        ->name('games.dashboard');

    Route::get('games', [GameController::class, 'index'])
        ->name('games.index');

    Route::get('games/{game}', [GameController::class, 'show'])
        ->name('games.show');
});



Auth::routes();


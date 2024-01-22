<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    Route::get('/', [\App\Http\Controllers\SiteController::class, 'index'])->name('site.index');

    Route::group(['middleware' => ['guest']], function() {
        Route::get('/register', function () {
            return view('site.register');
        });
        Route::post('/register', [\App\Http\Controllers\SiteController::class, 'register'])->name('register.perform');

        Route::get('/login', function () {
            return view('site.login');
        });
        Route::post('/login', [\App\Http\Controllers\SiteController::class, 'login'])->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/logout', [\App\Http\Controllers\SiteController::class, 'logout'])->name('logout.perform');

        Route::get('/chat/{user_id}', [\App\Http\Controllers\ChatController::class, 'index'])->name('message.chat');
        Route::post('/chat/message', [\App\Http\Controllers\ChatController::class, 'message'])->name('message.send');
    });
});

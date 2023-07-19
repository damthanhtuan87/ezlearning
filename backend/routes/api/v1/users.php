<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes for User
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
* API with Auth
*/


/**************************
 ***** AUTHENTICATION *****
 **************************/

 Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::middleware(['throttle:login'])->group(function () {
        Route::post('login', 'login');
    });
    Route::post('request-password', 'requestPassword')->name('password.request');
    Route::post('reset-password', 'resetPassword')->name('password.reset');
    Route::post('refresh-token', 'refreshToken')->name('token.refresh');
    Route::post('activate-account', 'activateAccount')->name('account.activate');
}); //END AUTHENTICATION

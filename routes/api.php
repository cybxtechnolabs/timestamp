<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');

Route::post('forgot-password/send-code', 'API\ForgotPasswordController@sendCode');
Route::post('forgot-password/verify-code', 'API\ForgotPasswordController@verifyCode');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('profile', 'API\UserController@updateProfile');
    Route::post('change-password', 'API\UserController@changePassword');

    Route::post('forgot-password/reset-password', 'API\ForgotPasswordController@resetPassword');
});

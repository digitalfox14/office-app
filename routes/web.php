<?php

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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('logout', [\App\Http\Controllers\Api\UserController::class, 'logout']);
        Route::get('refresh', [\App\Http\Controllers\Api\UserController::class, 'refreshUser']);
        Route::post('attendance', [\App\Http\Controllers\AttendanceController::class, 'userAttendance']);
        Route::get('createAttLog', [\App\Http\Controllers\AttendanceController::class, 'createLog']);
    });
});


Route::view('/{any}', 'layouts.app')->middleware(['auth'])->where('any', '.*');
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
        Route::post('punch-in', [\App\Http\Controllers\AttendanceController::class, 'punchIn']);
        Route::get('get-attendance', [\App\Http\Controllers\AttendanceController::class, 'getAttendance']);
        Route::get('punch-log', [\App\Http\Controllers\AttendanceController::class, 'punchLog']);
        Route::post('punch-out/{id}', [\App\Http\Controllers\AttendanceController::class, 'punchOut']);
        Route::get('get-user-attendance', [\App\Http\Controllers\AttendanceController::class, 'userAttendance']);
    });
});


Route::view('/{any}', 'layouts.app')->middleware(['auth'])->where('any', '.*');
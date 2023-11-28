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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('logout', [\App\Http\Controllers\Api\UserController::class, 'logout']);
    });
});


Route::view('/{any}', 'layouts.app')->middleware(['auth'])->where('any', '.*');
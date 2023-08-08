<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PerdinController;
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

Route::controller(AuthController::class)->group(function() {
    Route::get('/', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/history', 'history')->name('history');
    Route::get('/master-city', 'city')->name('city');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/user/ajax', 'indexAjax')->name('indexUser');
    Route::post('/user/add', 'store')->name('storeUser');
    Route::post('/user/update', 'update')->name('updateUser');
    Route::post('/user/delete', 'destroy')->name('deleteUser');
});

Route::controller(CityController::class)->group(function() {
    Route::get('/city/ajax', 'indexAjax')->name('indexCity');
    Route::post('/city/add', 'store')->name('storeCity');
    Route::post('/city/update', 'update')->name('updateCity');
    Route::post('/city/delete', 'destroy')->name('deleteCity');
});

Route::controller(PerdinController::class)->group(function() {
    Route::get('/perdin/ajax', 'indexAjax')->name('indexPerdin');
    Route::post('/perdin/add', 'store')->name('storePerdin');
    Route::post('/perdin/approve', 'approve')->name('approvePerdin');
    Route::post('/perdin/reject', 'reject')->name('rejectPerdin');
});
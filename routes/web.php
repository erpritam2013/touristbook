<?php

use App\Http\Controllers\HotelController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', function () {
       return view('admin.dashboard');
    })->name('dashboard');

    // Hotel Resource
    Route::prefix('hotels')->name('hotels.')->group(function() {
        Route::get('/', [HotelController::class, 'index'])->name('index');
        Route::get('create', [HotelController::class, 'create'])->name('create');
    });
});
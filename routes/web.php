<?php

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ParkingSpaceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Policies\SystemPolicy;
use App\System;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (\auth()->check()){
        return redirect('/home');
    }

    return redirect('/login');
});
Auth::routes();

Route::middleware('auth')->group(function (){
    Route::get('/dashboard', [HomeController::class , 'dashboard']);
    Route::get('/parking-space/all', [ParkingSpaceController::class , 'index'])->middleware('can:admin,'. System::class);
    Route::get('/parking-space/create', [ParkingSpaceController::class , 'create'])->middleware('can:admin,'. System::class);;
    Route::post('/parking-space/create', [ParkingSpaceController::class , 'store'])->middleware('can:admin,'. System::class);;
    Route::get('/parking-space/{location}/edit', [ParkingSpaceController::class , 'edit'])->middleware('can:admin,'. System::class);;
    Route::post('/parking-space/{location}/edit', [ParkingSpaceController::class , 'update'])->middleware('can:admin,'. System::class);;
    Route::get('/parking-space/{location}/delete', [ParkingSpaceController::class , 'destroy'])->middleware('can:admin,'. System::class);;
    Route::get('/parking-space/{location}/activate', [ParkingSpaceController::class , 'activate'])->middleware('can:admin,'. System::class);;
    Route::get('/parking-space/{location}/block', [ParkingSpaceController::class , 'block'])->middleware('can:admin,'. System::class);;

    Route::get('/home', [ParkingController::class , 'index'])->name('home');
    Route::get('/parking/{location}/create', [ParkingController::class , 'create']);
    Route::post('/parking/{location}/create', [ParkingController::class , 'store']);
    Route::post('/parking/{request}/accept', [ParkingController::class , 'accept']);
    Route::get('/parking/{request}/online', [ParkingController::class , 'online']);
    Route::get('/parking/{request}/override', [ParkingController::class , 'override'])->middleware('can:admin,'. System::class);;


    Route::get('/users/all', [UserController::class , 'index'])->middleware('can:admin,'. System::class);;
    Route::get('/users/{user}/admin', [UserController::class , 'admin'])->middleware('can:admin,'. System::class);;
    Route::get('/users/{user}/remove', [UserController::class , 'remove'])->middleware('can:admin,'. System::class);;


    Route::get('/vehicles/all', [VehicleController::class , 'index']);
    Route::get('/vehicles/create', [VehicleController::class , 'create']);
    Route::post('/vehicles/create', [VehicleController::class , 'store']);
    Route::get('/vehicles/{vehicle}/edit', [VehicleController::class , 'edit']);
    Route::post('/vehicles/{vehicle}/edit', [VehicleController::class , 'update']);
    Route::get('/vehicles/{vehicle}/view', [VehicleController::class , 'show']);
    Route::get('/vehicles/{vehicle}/delete', [VehicleController::class , 'destroy']);

    Route::get('/requests/all', [RequestsController::class , 'index']);
    Route::get('/payments/all', [PaymentController::class , 'index']);
});




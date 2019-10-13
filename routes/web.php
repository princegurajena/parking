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
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/parking-space/all', [ParkingSpaceController::class , 'index']);
Route::get('/parking-space/create', [ParkingSpaceController::class , 'create']);
Route::post('/parking-space/create', [ParkingSpaceController::class , 'store']);
Route::get('/parking-space/{location}/edit', [ParkingSpaceController::class , 'edit']);
Route::post('/parking-space/{location}/edit', [ParkingSpaceController::class , 'update']);
Route::get('/parking-space/{location}/delete', [ParkingSpaceController::class , 'destroy']);
Route::get('/parking-space/{location}/activate', [ParkingSpaceController::class , 'activate']);
Route::get('/parking-space/{location}/block', [ParkingSpaceController::class , 'block']);

Route::get('/home', [ParkingController::class , 'index'])->name('home');
Route::get('/parking/{location}/create', [ParkingController::class , 'create']);
Route::post('/parking/{location}/create', [ParkingController::class , 'store']);
Route::post('/parking/{request}/accept', [ParkingController::class , 'accept']);
Route::get('/parking/{request}/online', [ParkingController::class , 'online']);


Route::get('/users/all', [UserController::class , 'index']);
Route::get('/users/{user}/admin', [UserController::class , 'admin']);
Route::get('/users/{user}/remove', [UserController::class , 'remove']);


Route::get('/vehicles/all', [VehicleController::class , 'index']);
Route::get('/vehicles/create', [VehicleController::class , 'create']);
Route::post('/vehicles/create', [VehicleController::class , 'store']);
Route::get('/vehicles/{vehicle}/edit', [VehicleController::class , 'edit']);
Route::post('/vehicles/{vehicle}/edit', [VehicleController::class , 'update']);
Route::get('/vehicles/{vehicle}/view', [VehicleController::class , 'show']);
Route::get('/vehicles/{vehicle}/delete', [VehicleController::class , 'destroy']);

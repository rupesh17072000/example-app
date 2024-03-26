<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\DoctorController;



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
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthenticationController::class, 'register'])->name('register');
Route::post('login', [AuthenticationController::class, 'login'])->name('login');
 
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
 });
Route::middleware('auth:api')->group(function () {
    // Appointments
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::post('/appointments', [AppointmentController::class, 'store']); 
    Route::put('/appointments/{id}', [AppointmentController::class, 'store']);

    // Doctor Appointments
    Route::get('/doctors/appointments', [DoctorController::class, 'index']);
    Route::put('/doctors/appointments/{id}', [DoctorController::class, 'update']);
});




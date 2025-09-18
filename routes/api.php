<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class,'logout']);

    Route::post('/bookings',[BookingController::class,'store']);
    Route::put('/bookings/{id}',[BookingController::class,'update']);
    Route::delete('/bookings/{id}',[BookingController::class,'destroy']);
    Route::get('/my-bookings',[BookingController::class,'myBookings']);
    Route::get('/specialist-bookings',[BookingController::class,'specialistBookings']);

    Route::get('/services',[ServiceController::class,'index']);
    Route::post('/services',[ServiceController::class,'store']);
    Route::put('/services/{id}',[ServiceController::class,'update']);
    Route::delete('/services/{id}',[ServiceController::class,'destroy']);
});

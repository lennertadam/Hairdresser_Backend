<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ServcieController;
use App\Http\Controllers\ReservationController;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

//SERVICES
Route::get("/service",[ServcieController::class,"getServices"]);
Route::get("/service/{id}",[ServcieController::class,"getServices"]);
Route::post("/service",[ServcieController::class,"create"]);
Route::put("/service/{id}",[ServcieController::class,"update"]);
Route::delete("/service/{id}",[ServcieController::class,"destroy"]);

//RESERVATIONS
Route::get("/reservation",[ReservationController::class,"getReservations"]);
Route::get("/reservation/{id}",[ReservationController::class,"getReservation"]);
Route::get("/activereservation",[ReservationController::class,"getActiveReservations"]); //?
Route::get("/reservation/{barber_id}",[ReservationController::class,"getBarberReservation"]); //?
Route::post("/reservation",[ReservationController::class,"create"]);
Route::put("/reservation/{id}",[ReservationController::class,"update"]);
Route::delete("/reservation/{id}",[ReservationController::class,"destroy"]);
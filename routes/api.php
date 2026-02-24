<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReservationController;

use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AdminController;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/
//USER
Route::post("/register",[UserController::class,"register"]);
Route::post("/login",[UserController::class,"login"]);

Route::get("/service",[ServiceController::class,"getServices"]);
Route::get("/service/{id}",[ServiceController::class,"getService"]);

Route::middleware([ "auth:sanctum" ])->group( function() {
    Route::post( "/logout", [ UserController::class, "logout" ]);


    Route::get("/user",[UserController::class,"getUsers"]);
    Route::get("/barber",[UserController::class,"getBarbers"]);

    Route::put("/revokeRole/{id}",[AdminController::class,"revokeRole"]);
    Route::put("/giveAdmin/{id}",[AdminController::class,"giveAdmin"]);
    Route::put("/giveBarber/{id}",[AdminController::class,"giveBarber"]);
    Route::put("/giveInactive/{id}",[AdminController::class,"giveInactive"]);

    //SERVICES

    Route::post("/service",[ServiceController::class,"create"]);
    Route::put("/service/{id}",[ServiceController::class,"update"]);
    Route::delete("/service/{id}",[ServiceController::class,"destroy"]);

    //RESERVATIONS
    Route::get("/reservation",[ReservationController::class,"getReservations"]);
    Route::get("/reservation/{id}",[ReservationController::class,"getReservation"]);
    Route::get("/activeReservation",[ReservationController::class,"getActiveReservations"]);
    Route::get("/barberReservation/{barber_id}",[ReservationController::class,"getBarberReservations"]);
    Route::get("/customerReservation/{customer_id}",[ReservationController::class,"getCustomerReservations"]);
    Route::get("/barberActiveReservation/{barber_id}",[ReservationController::class,"getBarberActiveReservations"]);
    Route::post("/reservation",[ReservationController::class,"create"]);
    Route::put("/reservation/{id}",[ReservationController::class,"update"]);
    Route::put("/inactiveReservation/{id}",[ReservationController::class,"setInactive"]);
    Route::delete("/reservation/{id}",[ReservationController::class,"destroy"]);
    
});
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Http\Requests\ReservationRequest;
use Carbon\Carbon;

use App\Traits\ResponseTrait;

class ReservationController extends Controller
{
    use ResponseTrait;

    public function getReservations(){
        $reservations=Reservation::all();

        return $this->sendResponse($reservations);
    }
    
    public function getReservation($id){
        $reservation=Reservation::find($id)->get();

        return $this->sendResponse($reservation);
    }

    public function getActiveReservations(){
        $reservations=Reservation::where("active",true)->get();

        return $this->sendResponse($reservations);
    }

    public function getBarberReservations($barber_id){
        $reservations=Reservation::where("barber_id",$barber_id)->get();

        return $this->sendResponse($reservations);
    }

    public function getCustomerReservations($customer_id){
        $reservations=Reservation::where("customer_id",$customer_id)->get();

        return $this->sendResponse($reservations);
    }


    public function getBarberActiveReservations($barber_id){
        $reservations=Reservation::where(["barber_id"=>$barber_id,"active"=>true])->get();

        return $this->sendResponse($reservations);
    }

    public function getUpcomingReservations(){
        $reservations=Reservation::where("status","upcoming")->get();

        return $this->sendResponse($reservations);
    }

    public function getCompleteReservations(){
        $reservations=Reservation::where("status","complete")->get();

        return $this->sendResponse($reservations);
    }
    

    public function create(ReservationRequest $request){
        $validRequest=$request->validated();


        if($validRequest["start_time"]>$validRequest["end_time"]){
            return $this->sendError("Művelet nem végrehajtható","A kezdeti időpont később van mint a vég időpont",400);
        }

        if (Carbon::parse($validRequest["start_time"])->lte(Carbon::now())) {
            return $this->sendError("Művelet nem végrehajtható","A kezdeti időpont korábban van mint a jelen",400);
        }


        

        $reservation=new Reservation;
        
        $reservation->start_time=$validRequest["start_time"];
        $reservation->end_time=$validRequest["end_time"];
        $reservation->price=$validRequest["price"];
        $reservation->barber_id=$validRequest["barber_id"];
        $reservation->customer_id=$validRequest["customer_id"];
        $reservation->active=$validRequest["active"];
        $reservation->status=$validRequest["status"];

        $reservation->save();

        return $this->sendResponse($reservation,"Sikeres írás adatbázisba");
    }

     public function update(ReservationRequest $request,$id){
        $validRequest=$request->validated();

        $reservation=Reservation::find($id);

        if( is_null( $reservation )) {

            return $this->sendError( "Művelet nem végrehajtható", "Nem létezik ilyen rekord", 405 );

        }
        else{
            if($validRequest["start_time"]>$validRequest["end_time"]){
                return $this->sendError("Művelet nem végrehajtható","A kezdeti időpont később van mint a vég időpont",400);
            }

            if (Carbon::parse($validRequest["start_time"])->lte(Carbon::now())) {
            return $this->sendError("Művelet nem végrehajtható","A kezdeti időpont korábban van mint a jelen",400);
            }


            $reservation->start_time=$validRequest["start_time"];
            $reservation->end_time=$validRequest["end_time"];
            $reservation->price=$validRequest["price"];
            $reservation->barber_id=$validRequest["barber_id"];
            $reservation->customer_id=$validRequest["customer_id"];
            $reservation->active=$validRequest["active"];
            $reservation->status=$validRequest["status"];

            

            $reservation->update();

            return $this->sendResponse( $reservation, "Sikeres módosítás" );
        }

    }

    public function destroy($id){

        $reservation=Reservation::find($id);

        if( is_null( $reservation )) {

            return $this->sendError( "Művelet nem végrehajtható", "Nem létezik ilyen rekord", 405 );

        }
        else{
            $reservation->delete();

            return $this->sendResponse( $reservation, "Sikeres törlés" );
        }
    }


    //--Set status functions

    public function setComplete($id){
        $reservation=Reservation::find($id);

        if( is_null( $reservation )) {

            return $this->sendError( "Művelet nem végrehajtható", "Nem létezik ilyen rekord", 405 );

        }
        else{
            $reservation->active=false;
            $reservation->status="complete";
            $reservation->update();
            return $this->sendResponse( $reservation, "Sikeres inaktivitás jelölés" );
        }
    }

    public function setCancelled($id){
        $reservation=Reservation::find($id);

        if( is_null( $reservation )) {

            return $this->sendError( "Művelet nem végrehajtható", "Nem létezik ilyen rekord", 405 );

        }
        else{
            $reservation->active=false;
            $reservation->status="cancelled";
            $reservation->update();
            return $this->sendResponse( $reservation, "Sikeres inaktivitás jelölés" );
        }
    }


    public function setInvalid($id){
        $reservation=Reservation::find($id);

        if( is_null( $reservation )) {

            return $this->sendError( "Művelet nem végrehajtható", "Nem létezik ilyen rekord", 405 );

        }
        else{
            $reservation->active=false;
            $reservation->status="invalid";
            $reservation->update();
            return $this->sendResponse( $reservation, "Sikeres inaktivitás jelölés" );
        }
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;

use App\Traits\ResponseTrait;

class ReservationController extends Controller
{
    use ResponseTrait;

    public function getReservations(){
        $reservations=Reservation::all();

        $this->sendResponse($reservations);
    }
    
    public function getReservation($id){
        $reservation=Reservation::find($id);

        $this->sendResponse($reservation);
    }

    public function create(ReservationRequest $request){
        $validRequest=$request->validated();

        $reservation=new Reservation;
        
        $reservation->start_time=$validRequest["start_time"];
        $reservation->price=$validRequest["price"];
        $reservation->barber_id=$validRequest["barber_id"];
        $reservation->customer_id=$validRequest["customer_id"];
        $reservation->active=$validRequest["active"];

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

            $reservation->start_time=$validRequest["start_time"];
            $reservation->price=$validRequest["price"];
            $reservation->barber_id=$validRequest["barber_id"];
            $reservation->customer_id=$validRequest["customer_id"];
            $reservation->active=$validRequest["active"];

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

    
}

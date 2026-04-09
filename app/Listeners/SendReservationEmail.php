<?php

namespace App\Listeners;

use App\Events\ReservationMade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationMadeMail;
use App\Models\User;

class SendReservationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReservationMade $event): void
    {
        $reservationData=$event->reservationData;

        $barber=User::find($reservationData["barber_id"]);
        $customer=User::find($reservationData["customer_id"]);
        
        $sentData=[
            "start_time"=>$reservationData["start_time"],
            "end_time"=>$reservationData["end_time"],
            "customer"=>$customer->name,
            "barber"=>$barber->name,
            ];
        

        Mail::to($customer->email)->send(new ReservationMadeMail($sentData));
    }
}

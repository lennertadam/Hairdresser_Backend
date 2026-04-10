<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;

use App\Traits\ResponseTrait;

class AdminController extends Controller
{
    use ResponseTrait;

    public function giveAdmin($id){

        $user=User::find($id);

     

        if ($user->role=="admin" or $user->role=="super-admin" ) {
            return $this->sendError("Művelet nem végrehajtható", "A felhasználó már admin vagy szuperadmin",401);
        }
        else {

        $user->role="admin";

        $user->update();

        return $this->sendResponse( $user, "Sikeres módosítás" );
            
        }
    }

    public function revokeRole($id){

        $user=User::find($id);

        if ($user->role=="barber") {
            Reservation::where(["barber_id"=>$user->id,"status"=>"upcoming"])
            ->get()
            ->each(function (Reservation $reservation){
                $reservation->status="invalid";
                $reservation->update();
            });
        }

        $user->role="user";

        $user->update();

        return $this->sendResponse( $user, "Sikeres módosítás" );
    }

    public function giveBarber($id){
        $user=User::find($id);

        $user->role="barber";

        $user->update();

        return $this->sendResponse( $user, "Sikeres módosítás" );
    }

    public function giveInactive($id){

        $user=User::find($id);

        if ($user->role=="barber") {
            Reservation::where(["barber_id"=>$user->id,"status"=>"upcoming"])
            ->get()
            ->each(function (Reservation $reservation){
                $reservation->status="invalid";
                $reservation->update();
            });
        }

        $user->role="inactive";

        $user->update();

        return $this->sendResponse( $user, "Sikeres módosítás" );
    }
}

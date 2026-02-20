<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use App\Traits\ResponseTrait;

class AdminController extends Controller
{
    use ResponseTrait;

    //Superadmin level function to give someone admin role
    //UNTESTED (Need to change how roles work before testing)
    //Also, remember to make a revokeAdmin function as well

    public function giveAdmin($username){
        $user=User::where("username",$username)->first();

        if ($user->role=="admin"/*Admin Role*/ or "super-admin" /*Superadmin Role*/) {
            return $this->sendError("Művelet nem végrehajtható", "A felhasználó már admin vagy szuperadmin",401);
        }
        else {

        $user->role="admin";//Admin Role

        $user->update();

        return $this->sendResponse( $reservation, "Sikeres módosítás" );
            
        }
    }

    public function revokeRole($username){
        $user=User::where("username",$username)->first();

        $user->role="user";

        $user->update();

        return $this->sendResponse( $reservation, "Sikeres módosítás" );
    }

    public function giveBarber($username){
        $user=User::where("username",$username)->first();

        $user->role="barber";

        $user->update();

        return $this->sendResponse( $reservation, "Sikeres módosítás" );
    }

    public function makeInactive($username){
        $user=User::where("username",$username)->first();

        $user->role="inactive";

        $user->update();

        return $this->sendResponse( $reservation, "Sikeres módosítás" );
    }
}

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

    public function giveAdmin($id){

        $user=User::find($id);

     

        if ($user->role=="admin"/*Admin Role*/ or "super-admin" /*Superadmin Role*/) {
            return $this->sendError("Művelet nem végrehajtható", "A felhasználó már admin vagy szuperadmin",401);
        }
        else {

        $user->role="admin";//Admin Role

        $user->update();

        return $this->sendResponse( $user, "Sikeres módosítás" );
            
        }
    }

    public function revokeRole($id){

        $user=User::find($id);

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

        $user->role="inactive";

        $user->update();

        return $this->sendResponse( $user, "Sikeres módosítás" );
    }
}

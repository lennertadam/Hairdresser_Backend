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

    public function giveAdmin($username){
        $user=User::where("username",$username)->first();

        if ($user->role==100/*AdminRole*/ or 150 /*SuperadminRole*/) {
            return $this->sendError("Művelet nem végrehajtható", "A felhasználó már admin vagy szuperadmin",401);
        }
        else {

        $user->role=100;//AdminRole goes here

        $user->update();

        return $this->sendResponse( $reservation, "Sikeres módosítás" );
            
        }
    }
}

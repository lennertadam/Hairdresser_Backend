<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;

use App\Traits\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;
    
    
//     public function getUserId( $username ){

//         // $userName=$user->username;

//         $foundUser=User::where("username",$username)->first();
//         $id=$foundUser->id;

//         return $foundUser->id;
//     }

    public function getUsers(){
        $users=User::all();

        return $this->sendResponse($users);
    }

    public function getBarbers(){
        $barbers=User::where("role","barber")->get();

        return $this->sendResponse($barbers);
    }

}

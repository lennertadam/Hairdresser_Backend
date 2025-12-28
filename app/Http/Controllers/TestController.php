<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Http\JsonResponse;

use App\Traits\ResponseTrait;

class TestController extends Controller
{
    use ResponseTrait;

    public function test1(){
        $value=32;

        return $this->sendResponse($value);
    }
    //Use TestController to check ResponseTrait and returning error codes!

    public function userIdTest(){//WORKS!!!
        // $user=new User();
        // $user->username="User1";
        // $user->name="Felhasználó Feri";
        // $user->password="Aa123";
        // $user->role=0;
        // $user->email="Feri@email.lan";
        // $user->active=true;
        $userName="User1";

        $user=User::where("username",$userName)->first();
        $id=$user->id;

        return $this->sendResponse($id);
    }
}

<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;

class RegisterService
{

    use ResponseTrait;

    public function __construct()
    {
    
    }

    public function create(array $data){
        $user=new User();

        $user->username=$data["username"];
        $user->name = $data[ "name" ];
        $user->email = $data[ "email" ];
        $user->password = Hash::make( $data[ "password" ]);
        $user->role = "user";


        $user->save();

        return $this->sendResponse( $data, "Sikeres regisztráció." );
        }

}

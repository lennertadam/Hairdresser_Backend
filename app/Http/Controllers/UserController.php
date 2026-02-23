<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use App\Services\RegisterService;
use App\Services\TokenService;

use App\Models\User;

use App\Traits\ResponseTrait;



class UserController extends Controller
{
    use ResponseTrait;

    protected RegisterService $registerService;
    protected TokenService $tokenService;

    public function __construct(RegisterService $registerService, TokenService $tokenService){
        $this->registerService=$registerService;
        $this->tokenService=$tokenService; 
    }

    public function register( RegisterRequest $request ) {

        $validated = $request->validated();

        return $this->registerService->create( $validated );
    }

    public function login(LoginRequest $request){

        $validated = $request->validated();

        if( Auth::attempt([ "username" => $validated[ "username" ], "password" => $validated[ "password" ]])){
            $authUser = Auth::user();

            $token = $this->tokenService->generateToken( $authUser );

            $response =  [

                    "id"=>$authUser->id,
                    "username" => $authUser->username,
                    "role" => $authUser->role,
                    "email" => $authUser->email,
                    "token" => $token,
            ];
            return $this->sendResponse([ $response, "message" => "Sikeres bejelentkezés" ]);
        }
        else {
            return $this->sendError( "Autentikációs hiba", [ "Felhasználónév vagy jelszó nem megfelelő" ], 401 );
        }

    }

    public function logout() {

        $user = auth( "sanctum" )->user();
        
        return $success = $this->tokenService->deleteToken( $user );
    }


    public function getUserIdByUsername($username){
        $user=User::where("username",$username)->first();

        return $this->sendResponse($user->id);
    }


    public function getUsers(){
        $users=User::all();

        return $this->sendResponse($users);
    }

    public function getBarbers(){
        $barbers=User::where("role","barber")->get();

        return $this->sendResponse($barbers);
    }

}

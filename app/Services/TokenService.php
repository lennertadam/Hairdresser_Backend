<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ResponseTrait;

class TokenService
{
    use ResponseTrait;
    protected AbilityService $abilityService;

    public function __construct( AbilityService $abilityService ) {

        $this->abilityService = $abilityService;
    }


    public function generateToken( $user ) {

        if( $user->role === "super-admin" ) {

            return $user->createToken( $user->username . "Token", $this->abilityService->createSuperAbilities() )->plainTextToken;

        }
        else if( $user->role === "admin" ){

            return $user->createToken( $user->username . "Token", $this->abilityService->createAdminAbilities()  )->plainTextToken;
        
        }
        else if( $user->role === "barber" ){

            return $user->createToken( $user->username . "Token", $this->abilityService->createBarberAbilities()  )->plainTextToken;
        
        }
        else if( $user->role === "user" ){

            return $user->createToken( $user->username . "Token", $this->abilityService->createUserAbilities() )->plainTextToken;
        }
        else{
            return $this->sendError( "Bejelentkezés hiba", [ "A felhasználó inaktív.", 401 ]);
        }
    }

    public function deleteToken( $user ) {

        $success = $user->currentAccessToken()->delete();

        if( !$success ) {

            return $this->sendError( "Végrehajtási hiba", [ "Hiba a kijelentkezés során.", 422 ]);
        }
        
        return $this->sendResponse([ "username" => $user->username, "Sikeres kijelentkezés" ]);
    }
}

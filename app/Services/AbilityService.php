<?php

namespace App\Services;

class AbilityService
{
    public function __construct()
    {
        
    }

    public function createSuperAbilities() {

        return [ "*" ];
    }

    public function createAdminAbilities(){
        return [
            "users:create",
            "users:read",
            "users:update",
            
            "services:read",
            "services:create",
            "services:update",

            "reservations:read",
            "reservations:create",
            "reservations:update",

            ];
    }

    public function createBarberAbilities(){

        return [
            "users:create",
            "users:update",
            
            "services:read",

            "reservations:read",
            "reservations:create",
            "reservations:update",

        ];

    }

    public function createUserAbilities(){

        return [
            "users:create",
            "users:update",

            "services:read",

            "reservations:read",
            "reservations:create",
            "reservations:update",
        ];

    }
}

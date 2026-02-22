<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table( "users" )->insert([
            "username"=>"User1",
            "name"=>"Felhasználó Ferdinánd",
            "password"=>bcrypt("Aa123!"),
            "role"=>"super-admin",
            "email"=>"Ferdinánd@email.lan"
        ]);

        DB::table( "users" )->insert([
            "username"=>"User2",
            "name"=>"Felhasználó Fülöp",
            "password"=>bcrypt("Aa123!"),
            "role"=>"admin",
            "email"=>"Fülöp@email.lan"
        ]);

        DB::table( "users" )->insert([
            "username"=>"User3",
            "name"=>"Felhasználó Feri",
            "password"=>bcrypt("Aa123!"),
            "role"=>"barber",
            "email"=>"Feri@email.lan"
        ]);

        DB::table( "users" )->insert([
            "username"=>"User4",
            "name"=>"Felhasználó Franciska",
            "password"=>bcrypt("Aa123!"),
            "role"=>"user",
            "email"=>"Franciska@email.lan"
        ]);

        DB::table( "users" )->insert([
            "username"=>"User5",
            "name"=>"Felhasználó Fred",
            "password"=>bcrypt("Aa123!"),
            "role"=>"inactive",
            "email"=>"Fred@email.lan"
        ]);
    }
}

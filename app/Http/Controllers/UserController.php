<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService;

use App\Models\User;

use App\Traits\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;

    protected RegisterService $registerService;

    public function __construct(RegisterService $registerService){
        $this->registerService=$registerService;
        /* Include token service here when it works */    
    }

    public function register( RegisterRequest $request ) {

        $validated = $request->validated();

        return $this->registerService->create( $validated );
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

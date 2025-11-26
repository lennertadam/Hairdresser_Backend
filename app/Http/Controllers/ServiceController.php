<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Requests\ServiceRequest;

class ServiceController extends ResponseController
{
    public function getService(){
        $services=Service::all();

        $this->sendResponse($services);
    }

    public function create(ServiceRequest $request){
        $request->validated();

        $service=new Service;
        $service->service=$request["service"];

        $service->save();

        return $this->sendResponse($service,"Sikeres írás adatbázisba");
    }

    public function update(ServiceRequest $request,$id){
        $request->validated();

        $service=Service::find($id);

        if( is_null( $service )) {

            return $this->sendError( "Művelet nem végrehajtható", "Nem létezik ilyen rekord", 405 );

        }
        else{
            $service->service=$request["service"];

            $service->update();

            return $this->sendResponse( $package, "Sikeres módosítás" );
        }
    }

    public function destroy($id){

        $service=Service::find($id);

        if( is_null( $service )) {

            return $this->sendError( "Művelet nem végrehajtható", "Nem létezik ilyen rekord", 405 );

        }

        else {
            $service->delete();

            return $this->sendResponse( $package, "Sikeres törlés" );
        }
    }
}

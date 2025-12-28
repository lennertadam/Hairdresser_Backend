<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\ServiceRequest;

use App\Traits\ResponseTrait;

class ServiceController extends Controller
{

    use ResponseTrait;



    public function getServices(){
        $services=Service::all();

        return $this->sendResponse($services);
    }


    //Didn't work!

    // public function getServices(){
    //     $services=Service::where("reservation")->get();

    //     return $this->sendResponse($services);
    // }


    //DIDN'T WORK!!!

    // public function getServices(){
    //     $sql="SELECT * FROM services";

    //     $services=DB::select($sql);

    //     return $this->sendResponse($services);
    // }

    public function getService($id){
        $service=Service::find($id);

        return $this->sendResponse($service);
    }

    public function create(ServiceRequest $request){
        $validRequest=$request->validated();

        $service=new Service;
        $service->service=$validRequest["service"];
        $service->required_time=$validRequest["required_time"];

        $service->save();

        return $this->sendResponse($service,"Sikeres írás adatbázisba");
    }

    public function update(ServiceRequest $request,$id){
        $validRequest=$request->validated();

        $service=Service::find($id);

        if( is_null( $service )) {

            return $this->sendError( "Művelet nem végrehajtható", "Nem létezik ilyen rekord", 405 );

        }
        else{
            $service->service=$validRequest["service"];
            $service->required_time=$validRequest["required_time"];

            $service->update();

            return $this->sendResponse( $service, "Sikeres módosítás" );
        }
    }

    public function destroy($id){

        $service=Service::find($id);

        if( is_null( $service )) {

            return $this->sendError( "Művelet nem végrehajtható", "Nem létezik ilyen rekord", 405 );

        }

        else {
            $service->delete();

            return $this->sendResponse( $service, "Sikeres törlés" );
        }
    }
}

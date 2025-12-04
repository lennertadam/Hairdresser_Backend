<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservation extends Model
{
    
    /*
    public function service(){
        return $this->belongsTo(service::class);
    }
    */

    public function service(): BelongsToMany{
         return $this->belongsToMany(Service::class);
    }
}

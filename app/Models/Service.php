<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    public $timestamps = false;

    /*
    public function reservation(){
        return $this->hasMany(reservation::class);
    }
    */

    public function reservation(): BelongsToMany{
         return $this->belongsToMany(Reservation::class);
    }
}

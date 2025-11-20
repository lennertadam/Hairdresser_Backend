<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;

    public function reservation(){
        return $this->hasMany(reservation::class);
    }
}

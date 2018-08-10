<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    protected $guarded = [];

    public function offices(){
        return $this->hasOne('App\Office');
    }
}

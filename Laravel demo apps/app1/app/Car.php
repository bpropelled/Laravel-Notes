<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
  protected $guarded = [];

  public function mfg()
    {
        return $this->belongsTo('App\Mfg');
    }
}

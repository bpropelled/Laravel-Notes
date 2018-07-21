<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// You don't need the eloquent namespace
// class DDOptions extends Model
class DDOptions extends ReadOnly
{
   protected  $titles = ['Mr','Mrs','Miss', 'Shithead'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    public function device()
    {
      return $this->hasOne('App\Device');
    }
}

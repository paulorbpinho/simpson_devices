<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function messages()
    {
      return $this->hasMany('App\DeviceMessage');
    }
}

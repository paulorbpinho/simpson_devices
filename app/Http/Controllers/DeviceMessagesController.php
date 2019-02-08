<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Jobs\SaveDeviceMessage;

class DeviceMessagesController extends Controller
{
  public function store(Request $request)
  {
    $rules = [
      'seqNumber' => 'required',
      'temp' => 'required|numeric',
      'datetime' => 'required|numeric'
    ];
    $validator = Validator::make($request->all(), $rules);
    if($validator->fails()){
      return implode(' ', $validator->messages()->all());
    }else{
      $saveDeviceMessage = new SaveDeviceMessage($request->all());
      $this->dispatch($saveDeviceMessage);
      return 'ok';
    }
  }
}

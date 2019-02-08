<?php

namespace App\Http\Controllers;

use Validator;
use App\DeviceMessage;
use App\Device;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
      $device_message = new DeviceMessage;
      try
      {
        $device = Device::where('deviceId', $request->get('deviceId'))->firstOrFail();
        $device_message->device_id = $device->id;
      }
      catch(ModelNotFoundException $ex)
      {
        return 'Dispositivo não encontrado.';
      }
      $device_message->temp = $request->get('temp');
      $device_message->datetime = $request->get('datetime');
      $device_message->seqNumber = $request->get('seqNumber');
      $device_message->save();
      return 'ok';
    }
  }
}

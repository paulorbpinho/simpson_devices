<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Jobs\SaveDeviceMessage;
use App\Device;
use App\Environment;

class DeviceMessagesController extends Controller
{
  public function index()
  {
    $devices = Device::with('messages')->get();
    $envirolments = Environment::with(['device.messages'])->get();
    return response()->json([
      'devices' => $devices,
      'envirolments' => $envirolments
    ]);
  }

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

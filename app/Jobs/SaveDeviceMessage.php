<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\DeviceMessage;
use App\Device;

class SaveDeviceMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $device_message = new DeviceMessage;
        $device = Device::where('deviceId', $this->request['deviceId'])->firstOrFail();
        $device_message->device_id = $device->id;
        $device_message->temp = $this->request['temp'];
        $device_message->datetime = $this->request['datetime'];
        $device_message->seqNumber = $this->request['seqNumber'];
        $device_message->save();
    }
}

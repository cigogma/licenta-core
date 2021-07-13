<?php

namespace App\Services;

use App\Dto\StationDataDto;
use App\Dto\StationDeviceProbeDataDto;
use App\Models\StationDevice;
use App\Models\StationDeviceProbe;
use Illuminate\Support\Facades\Log;

class StationService
{
    public function __construct()
    {
    }


    public function registerStationData(StationDataDto $data)
    {
        $station = $data->station;
        foreach ($data->devices as $deviceData) {
            /** 
             * @var StationDevice
             */
            $device =  StationDevice::firstOrNew([
                'station_id' => $station->id,
                'mac' => $deviceData->mac
            ]);
            $device->save();
            $probes = $deviceData->probes->map(function ($probeData) {
                return $probeData->toArray();
            });
            Log::info($probes->count());
            $device->probes()->createMany($probes);

            // $probes = $deviceData->probes->map(function ($probeData) use ($device) {
            //     return [
            //         'station_device_id' => $device->id,
            //         'value' => $probeData->value,
            //         'type' => $probeData->type,
            //         'captured_at' => $probeData->captured_at,
            //     ];
            // });
            // StationDeviceProbe::createMany($probes);
        }
    }
}

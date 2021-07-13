<?php

namespace App\Dto;

use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\DataTransferObject;

class StationDataDto extends DataTransferObject
{
    public Station $station;

    /**
     * @todo fill with data for stations
     */

    /**
     * @var StationDeviceDataDto[]|Illuminate\Support\Collection
     */
    public $devices;

    public static function fromRequest(Request $request)
    {
        /**
         * @var Station
         */
        $station = $request->user();
        $devices = collect($request->input('devices'));
        $devicesDto = $devices->map(function ($deviceData) {
            $probes = collect($deviceData['probes'])->map(function ($probeData) {
                return new StationDeviceProbeDataDto([
                    'type' => $probeData['type'],
                    'value' => $probeData['value'],
                    'captured_at' => Carbon::parse($probeData['captured_at'])
                ]);
            });
            return new StationDeviceDataDto([
                'mac' => $deviceData['mac'],
                'probes' => $probes
            ]);
        });
        return new self([
            'station' => $station,
            'devices' => $devicesDto
        ]);
    }
}

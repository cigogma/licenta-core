<?php

namespace App\Http\Controllers;

use App\Dto\StationDataDto;
use App\Http\Resources\StationResource;
use App\Models\StationDevice;
use App\Services\StationDeviceService;
use App\Services\StationService;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StationDeviceMetricsController
{
    public function __construct(private StationService $stationService, private StationDeviceService $stationDeviceService)
    {
    }



    public function getMetrics(Request $request)
    {
        try {
            $user = $request->user();

            $device = StationDevice::find($request->route('device'));
            $period = new CarbonPeriod($request->input('from'), $request->input('until'), $request->input('interval'));
            $result = $this->stationDeviceService->getMetrics($device, $request->input('type'), $period);
            return response()->json(['result' => $result]);
        } catch (\Throwable $e) {
            throw ValidationException::withMessages(['error' => $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers\Stations;

use App\Dto\StationDataDto;
use App\Services\StationService;
use Illuminate\Http\Request;

class StationDataController
{
    public function __construct(private StationService $stationService)
    {
    }
    public function uploadData(Request $request)
    {

        $dto = StationDataDto::fromRequest($request);
        $this->stationService->registerStationData($dto);
        return response()->json()->status(200);
    }
}

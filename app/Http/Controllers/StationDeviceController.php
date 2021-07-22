<?php

namespace App\Http\Controllers;

use App\Dto\StationDataDto;
use App\Http\Resources\StationDeviceResource;
use App\Services\StationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StationDeviceController
{
    public function __construct(private StationService $stationService)
    {
    }


    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $station = $user->stations()->find($request->route('station'));
            if (!$station) {
                throw new Exception("Station not found!");
            }
            $devices = $station->station_devices;

            return response()->json(['station_devices' => StationDeviceResource::collection($devices)]);
        } catch (\Throwable $e) {
            throw ValidationException::withMessages([$e->getMessage()]);
        }
    }

    public function update(Request $request){
        try {
            $user = $request->user();
            $station = $user->stations()->find($request->route('station'));
            if (!$station) {
                throw new Exception("Station not found!");
            }
            $device = $station->station_devices()->find($request->route('device'));
            if (!$device){
                throw new Exception("Device not found!");
            }
            $data = $request->only(['name']);
            $device->fill($data);
            $device->save();
            return response()->json(['station_device' => new StationDeviceResource($device)]);
        } catch (\Throwable $e) {
            throw ValidationException::withMessages([$e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Dto\StationDataDto;
use App\Http\Resources\StationResource;
use App\Services\StationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StationController
{
    public function __construct(private StationService $stationService)
    {
    }

    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $stations = $user->stations;
            return response()->json(['stations' => StationResource::collection($stations)]);
        } catch (\Throwable $e) {
            throw ValidationException::withMessages([$e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = $request->user();
            $data = $request->all();
            $data['user_id'] = $user->id;
            $station = $this->stationService->register($data);
            return response()->json(['station' => new StationResource($station)]);
        } catch (\Throwable $e) {
            throw ValidationException::withMessages(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = $request->user();
            $station = $user->stations()->find($request->route('station'));
            if (!$station) {
                throw new Exception("Station not found!");
            }
            $station = $this->stationService->update($station, $request->all());
            return response()->json(['station' => new StationResource($station)]);
        } catch (\Throwable $e) {
            throw ValidationException::withMessages(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $user = $request->user();
            $station = $user->stations()->find($request->route('station'));
            if (!$station) {
                throw new Exception("Station not found!");
            }
            $this->stationService->delete($station);
            return response()->json();
        } catch (\Throwable $e) {
            throw ValidationException::withMessages(['error' => $e->getMessage()]);
        }
    }
}

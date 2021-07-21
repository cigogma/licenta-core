<?php

namespace App\Http\Controllers;

use App\Dto\StationDataDto;
use App\Http\Resources\StationApiKeyResource;
use App\Http\Resources\StationResource;
use App\Services\StationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StationApiKeyController
{
    public function __construct()
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
            $tokens = $station->tokens;
            return response()->json(['station_api_keys' => StationApiKeyResource::collection($tokens)]);
        } catch (\Throwable $e) {
            throw ValidationException::withMessages([$e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = $request->user();
            $station = $user->stations()->find($request->route('station'));
            if (!$station) {
                throw new Exception("Station not found!");
            }
            $token = $station->createToken($request->input("name"));
            return response()->json(['station_api_key' => new StationApiKeyResource($token->accessToken), 'plain_text_key' => $token->plainTextToken]);
        } catch (\Throwable $e) {
            throw ValidationException::withMessages(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            throw new Exception("Method not available!");
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
            $token = $station->tokens()->find($request->route('key'));
            if (!$token) {
                throw new Exception("Token not found!");
            }
            $token->delete();
            return response()->json();
        } catch (\Throwable $e) {
            throw ValidationException::withMessages(['error' => $e->getMessage()]);
        }
    }
}

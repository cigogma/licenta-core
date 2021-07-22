<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StationApiKeyController;
use App\Http\Controllers\Stations\StationDataController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\StationDeviceController;
use App\Http\Controllers\StationDeviceMetricsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => ['auth:sanctum'],
    'prefix' => "s"
], function () {
    Route::post('/data/upload', [StationDataController::class, 'uploadData']);
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('stations', StationController::class)->names('stations');
    Route::resource('stations.keys', StationApiKeyController::class)->names('stations.keys');
    Route::resource('stations.devices', StationDeviceController::class)->names('stations.devices');
    Route::get("devices/{device}/metrics", [StationDeviceMetricsController::class, 'getMetrics']);
    Route::get("devices/{device}/latest-value", [StationDeviceMetricsController::class, 'getLatestValue']);

});

<?php

namespace App\Http\Resources;

use App\Services\StationDeviceService;
use Illuminate\Http\Resources\Json\JsonResource;

class StationDeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'station_id' => $this->station_id,
            'name' => $this->name,
            'mac' => $this->mac,
            'sensors' => $this->sensors()
        ];
    }
}

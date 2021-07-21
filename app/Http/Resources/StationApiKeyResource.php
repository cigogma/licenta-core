<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StationApiKeyResource extends JsonResource
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
            'station_id' => $this->tokenable_id,
            'name' => $this->name,
            // 'token' => $this->token,
            'id' => $this->id
        ];
    }
}

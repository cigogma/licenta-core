<?php

namespace App\Dto;

use Spatie\DataTransferObject\DataTransferObject;


class StationDeviceDataDto extends DataTransferObject
{
    public ?int $id;

    public string $mac;
    /**
     * @var StationDeviceProbeDataDto[]|Illuminate\Support\Collection
     */
    public $probes;
}

<?php

namespace App\Dto;

use App\Models\Station;
use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class StationDeviceProbeDataDto extends DataTransferObject
{

    public string $type;

    public float $value = 0;

    public Carbon $captured_at;
}

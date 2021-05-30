<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Laravel\Passport\HasApiTokens;

class StationDeviceCapability extends Pivot
{
    public $pivotParent = StationDevice::class;
    /**
     * The name of the foreign key column.
     *
     * @var string
     */
    protected $foreignKey = 'station_device_id';

    /**
     * The name of the "other key" column.
     *
     * @var string
     */
    protected $relatedKey = 'capability_id';
}

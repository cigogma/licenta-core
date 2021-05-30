<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capability extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function station_devices()
    {
        return $this->hasManyThrough(StationDevice::class, StationDeviceCapability::class);
    }
}

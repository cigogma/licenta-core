<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationDeviceProbe extends Model
{
    use HasFactory;

    public $fillable = [
        'station_device_id',
        'value',
        'type',
        'captured_at'
    ];
}

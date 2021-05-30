<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class StationDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'mac',
        'station_id'
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function capabilities()
    {
        return $this->hasManyThrough(Capability::class, StationDeviceCapability::class);
    }
}

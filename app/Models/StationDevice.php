<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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

    public function probes()
    {
        return $this->hasMany(StationDeviceProbe::class);
    }

    public function capabilities()
    {
        return $this->hasManyThrough(Capability::class, StationDeviceCapability::class);
    }
    public function sensors()
    {
        $sensorTypes = $this->probes()->selectRaw('type')->groupBy('type')->get();
        $sensors = $sensorTypes->map(function ($sensorType) {
            $sensor =  $this->probes()->where('type', $sensorType->type)->orderBy('captured_at', 'DESC')->first();
            return [
                'lastValue' => $sensor->value,
                'name' => $sensor->type
            ];
        });
        return $sensors;
    }
}

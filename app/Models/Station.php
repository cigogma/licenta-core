<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

/**
 * @propriety int id
 * @propriety string name
 * @propriety string mac
 * @propriety string name
 */
class Station extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = [
        'name',
        'mac',
        'details'
    ];

    public function station_devices()
    {
        return $this->hasMany(StationDevice::class);
    }
}

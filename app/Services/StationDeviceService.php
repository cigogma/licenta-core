<?php

namespace App\Services;

use App\Dto\StationDataDto;
use App\Dto\StationDeviceProbeDataDto;
use App\Models\Station;
use App\Models\StationDevice;
use App\Models\StationDeviceProbe;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class StationDeviceService
{
    public function __construct()
    {
    }
    private function getAvgPeriod(Builder $b, Carbon $from, CarbonInterval $interval)
    {
        // $cacheSlug = $this->getCachedAvgPeriodSlug($slug, $from, $interval);
        $until = ($from->clone())->add($interval);
        $builder = clone ($b);
        $avg = 0;
        try {
            $avg = $builder
                ->whereBetween('captured_at', [$from, $until])
                ->avg('value');
        } catch (\Exception $e) {
        }
        $avg = $avg ?? 0;
        // Log::info(['slug' => $slug, 'cacheSlug' => $cacheSlug, 'from' => $from->toDateString(), 'until' => $until->toDateString(), 'avg' => $avg]);
        return $avg;
    }
    public function getMetrics(StationDevice $device, string $type, CarbonPeriod $period)
    {
        $builder = $device->probes()->where('type', $type)->getQuery();
        $dates = $period->toArray();
        array_pop($dates);
        $values = collect($dates)->map(function ($from) use ($builder, $period) {
            return $this->getAvgPeriod($builder, $from, $period->getDateInterval());
        });
        return ['values' => $values, 'labels' => $dates];
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStationDeviceProbesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_device_probes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_device_id')->nullable();
            $table->string('type');
            $table->float('value');
            $table->timestamp('captured_at')->default(DB::raw("NOW()"));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('station_device_probes');
    }
}

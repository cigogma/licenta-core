<?php

namespace App\Console\Commands;

use App\Models\Station;
use Illuminate\Console\Command;

class CreateStationToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'station:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $station = Station::query()->first();
        if (!$station) {
            return false;
        }
        print_r((string)$station->createToken("test"));
        return 0;
    }
}

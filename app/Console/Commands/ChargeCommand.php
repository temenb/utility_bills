<?php

namespace App\Console\Commands;

use App\Models\Repositories\MeterDataRepo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChargeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:charge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Charge all existand meters and prepare next charges';

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
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle()
    {
        $meterDataRepo = app()->make(MeterDataRepo::class);
        $meterDataRepo->prepareNextCharge();
        $meterDataCollection = $meterDataRepo->getAllForCharging();
        foreach ($meterDataCollection as $meterData) {
            DB::transaction(function() use ($meterDataRepo, $meterData) {
                $meterDataRepo->charge($meterData);
                $meterDataRepo->prepareNextCharge($meterData);
            });
        }
    }
}

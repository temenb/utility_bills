<?php

namespace App\Console\Commands;

use App\Models\Repositories\MeterDataRepo;
use App\Models\Repositories\MeterDataRepoEloquent;
use App\Models\Repositories\MeterDebtRepo;
use App\Models\Repositories\MeterDebtRepoEloquent;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\MeterRepoEloquent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class ChargeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:charge {--database=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Charge all existed meters and prepare next charges';

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
        $this->switchDatabase();

        /** @var MeterRepoEloquent $meterRepo */
        $meterRepo = app()->make(MeterRepo::class);
        $meterRepo->prepareNextChargeForAllMeters();

        /** @var MeterDataRepoEloquent $meterRepo */
        $meterDataRepo = app()->make(MeterDataRepo::class);
        $meterDataCollection = $meterDataRepo->getAllForCharging();

        /** @var MeterDebtRepoEloquent $meterRepo */
        $meterDeptRepo = app()->make(MeterDebtRepo::class);
        foreach ($meterDataCollection as $meterData) {
            $meterDeptRepo->charge($meterData);
        }

        $meterRepo->prepareNextChargeForAllMeters();
    }

    protected function switchDatabase(): void
    {
        $database = $this->option('database');
        if ($database) {
            Config::set('database.default', $database);
        }
    }
}

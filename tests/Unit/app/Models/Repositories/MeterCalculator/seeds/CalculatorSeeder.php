<?php

namespace Tests\Unit\app\Models\Repositories\MeterCalculator\seeds;

use Illuminate\Database\Seeder;
use App\Models\Entities\User;
use App\Models\Entities\Organization;
use App\Models\Entities\Service;
use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;
use App\Models\Entities\MeterDebt;

class CalculatorSeeder extends Seeder
{
    public function run()
    {
        $user = factory(User::class)->create();
        auth()->login($user);
        $organization = factory(Organization::class)->create();
        $service = factory(Service::class)->make();
        $organization->services()->save($service);
        $meter = factory(Meter::class)->make();
        $service->meters()->save($meter);
        $meter->mData()->save(factory(MeterData::class)->make());
        $meter->mData()->save(factory(MeterData::class)->make());
        $meter->mDebts()->save(factory(MeterDebt::class)->make());
        return $user;
    }
}

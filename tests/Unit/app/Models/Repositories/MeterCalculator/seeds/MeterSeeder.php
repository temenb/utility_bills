<?php

namespace Tests\Unit\app\Models\Repositories\MeterCalculator\seeds;

use Illuminate\Database\Seeder;
use App\Models\Entities\User;
use App\Models\Entities\Organization;
use App\Models\Entities\Service;
use App\Models\Entities\Meter;

class MeterSeeder extends Seeder
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
        return $meter;
    }
}

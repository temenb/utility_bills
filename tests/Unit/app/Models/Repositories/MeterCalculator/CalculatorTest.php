<?php

namespace Tests\Unit\app\Models\Repositories\MeterCalculator;

use App\Models\Entities\Meter;
use App\Models\Repositories\MeterRepoEloquent;
use App\Models\Repositories\OrganizationRepoEloquent;
use Tests\TestCase;
use App\Models\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\OrganizationRepo;
use Tests\Unit\app\Models\Repositories\MeterCalculator\seeds\CalculatorSeeder;

class CalculatorTest extends TestCase
{
//    use DatabaseTransactions;

    /**
     * @throws \Exception
     */
    public function testBasic()
    {
        $seeder = new CalculatorSeeder;
        /** @var User $user */
        $user = $seeder->run();
        /** @var Meter $meter */
        $meter = $user->organizations[0]->services[0]->meters[0];
        $meter->fill([
            'type' => Meter::ENUM_TYPE_MEASURING,
            'value' => 10,
        ]);
        $meter->save();
//        /** @var MeterRepoEloquent $meterRepo */
//        $meterRepo = resolve(MeterRepo::class);
//        $meterRepo->calculate($meter);
//        /** @var OrganizationRepoEloquent $organizationRepo */
//        $organizationRepo = resolve(OrganizationRepo::class);
//        $organizationRepo->getUserRelatedOrganizations($user);


    }
}

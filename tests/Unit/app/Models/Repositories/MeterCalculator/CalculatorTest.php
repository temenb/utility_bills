<?php

namespace Tests\Unit\app\Models\Repositories\MeterCalculator;

use App\Events\onMeterDataChanged;
use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;
use App\Models\Entities\MeterDebt;
use App\Models\Repositories\MeterRepoEloquent;
use App\Models\Repositories\OrganizationRepoEloquent;
use Tests\TestCase;
use App\Models\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\OrganizationRepo;
use Tests\Unit\app\Models\Repositories\MeterCalculator\seeds\MeterSeeder;

class CalculatorTest extends TestCase
{
//    use DatabaseTransactions;

    /**
     * @throws \Exception
     */
    public function testBasic()
    {
        $seeder = new MeterSeeder;

        /** @var Meter $meter */
        $meter = $seeder->run();
        $meter->fill([
            'type' => Meter::ENUM_TYPE_MEASURING,
            'rate' => 10,
        ])->save();

        $this->assertEquals(0, count($meter->mDebts));

        $mData = factory(MeterData::class)->create(['meter_id' => $meter->id, 'value' => 10]);

        event(new onMeterDataChanged($mData));
        $meter->refresh();
        $this->assertEquals(1, count($meter->mDebts));
        $this->assertEquals(100, $meter->mDebts[0]->value);

        $mData = factory(MeterData::class)->create(['meter_id' => $meter->id, 'value' => 50]);
        event(new onMeterDataChanged($mData));
        $meter->refresh();
        $this->assertEquals(2, count($meter->mDebts));
        $this->assertEquals(500, $meter->mDebts[1]->value);
    }
}

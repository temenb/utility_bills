<?php

namespace Tests\Unit\app\Models\Repositories\MeterCalculator;

use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;
use App\Models\Entities\MeterDebt;
use App\Models\Entities\User;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChargeCommandTest extends TestCase
{

//    use DatabaseTransactions;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        auth()->login(factory(User::class)->create());
    }

    /**
     *
     */
    public function testBasic()
    {
        $meter = factory(Meter::class)->create([
            'type' => Meter::ENUM_TYPE_PERIOD,
            'period' => '+1 hour',
            'disabled_months' => [],
            'rate' => 10,
        ]);

        $this->artisan('command:charge');

        $this->assertEquals(1, count($meter->mData));
        $this->assertEquals(0, count($meter->mDebts));
    }

    /**
     * A basic test example.
     */
    public function testCalculateNextDebt()
    {
        $period = '+1 hour';
        $meter = factory(Meter::class)->create([
            'type' => Meter::ENUM_TYPE_PERIOD,
            'period' => $period,
            'disabled_months' => [],
            'rate' => 10,
        ]);

        $bPeriod = $period;
        $bPeriod[0] = '-';

        $mData = factory(MeterData::class)->create([
            'meter_id' => $meter->id,
            'last' => 1,
            'charge_at' => $meter->created_at->modify($bPeriod)->modify($bPeriod)->modify($bPeriod),
            'value' => 9,
        ]);

        $this->artisan('command:charge');

        $mData->refresh();
        $this->assertNotNull($mData->handled_at);
        $this->assertEquals(1, $mData->last);
        $this->assertEquals($mData->value, $meter->mDebts[0]->value);

        $this->artisan('command:charge');

        $mData->refresh();
        $meter->refresh();
        $this->assertEquals(0, $mData->last);
        $this->assertEquals($mData->value + $meter->value, $meter->mDebts[0]->value);
    }
}

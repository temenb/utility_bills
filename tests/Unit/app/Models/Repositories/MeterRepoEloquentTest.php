<?php

namespace Tests\Unit\app\Models\Repositories;

use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;
use App\Models\Entities\User;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\MeterRepoEloquent;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MeterRepoEloquentTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @throws \Exception
     */
    public function prepareNextChargeForNewMeter1()
    {
        $user = factory(User::class)->create();
        auth()->login($user);
        $period = '+1 hour';
        $rate = 100500;
        $meter = factory(Meter::class)->create([
            'type' => Meter::ENUM_TYPE_PERIOD,
            'rate' => $rate,
            'disabled_months' => [],
            'period' => $period,
        ]);
        /** @var MeterRepoEloquent $meterRepo */
        $meterRepo = app()->make(MeterRepo::class);
        $meterRepo->prepareNextCharge($meter);

        $meter->refresh();
        $mData1 = $meter->mData[0];

        $this->assertEquals(1, count($meter->mData));
        $this->assertNull($mData1->handled_at);
        $this->assertEquals($rate, $mData1->value);
        $this->assertEquals($mData1->charge_at, $meter->created_at->modify($period));
        return $meter;
    }

    /**
     * @throws \Exception
     */
    public function prepareNextChargeForNewMeter2()
    {
        $meter = $this->prepareNextChargeForNewMeter1();
        $period = $meter->period;
        $bPeriod = $period;
        $bPeriod{0} = '-';
        $rate = $meter->rate;
        $mData1 = $meter->mData[0];

        $mData1->charge_at = $mData1->charge_at->modify($bPeriod)->modify($bPeriod);
        $mData1->handled_at = $mData1->charge_at;
        $mData1->save();
        /** @var MeterRepoEloquent $meterRepo */
        $meterRepo = app()->make(MeterRepo::class);
        $meterRepo->prepareNextChargeForAllMeters();
        $meter->refresh();
        $mData2 = $meter->mData[1];

        $this->assertEquals(2, count($meter->mData));
        $this->assertNull($mData2->handled_at);
        $this->assertEquals($rate, $mData1->value);
        $this->assertEquals($mData2->charge_at, $mData1->charge_at->modify($period));

        return $meter;
    }

    /**
     * @throws \Exception
     */
    public function testPrepareNextChargeForNewMeter3()
    {
        $meter = $this->prepareNextChargeForNewMeter2();
        $period = $meter->period;
        $bPeriod = $period;
        $bPeriod{0} = '-';
        $rate = $meter->rate;
        $mData1 = $meter->mData[1];

        $mData1->handled_at = $mData1->charge_at;
        $mData1->save();
        /** @var MeterRepoEloquent $meterRepo */
        $meterRepo = app()->make(MeterRepo::class);
        $meterRepo->prepareNextChargeForAllMeters();
        $meter->refresh();
        $mData2 = $meter->mData[2];
        $this->assertEquals(3, count($meter->mData));
        $this->assertNull($mData2->handled_at);
        $this->assertEquals($rate, $mData1->value);
        $this->assertEquals($mData2->charge_at, $mData1->charge_at->modify($period));

        $meterRepo->prepareNextChargeForAllMeters();
        $meter->refresh();
        $this->assertEquals(3, count($meter->mData));
    }
}

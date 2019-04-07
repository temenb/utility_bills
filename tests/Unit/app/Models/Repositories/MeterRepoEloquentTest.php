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
    public function testPrepareNextChargeForNewMeter()
    {
        $user = factory(User::class)->create();
        auth()->login($user);
        $period = '+1 hour';
        $rate = 100500;
        $bPeriod = '-1 hour';
        $meter = factory(Meter::class)->create([
            'type' => Meter::ENUM_TYPE_PERIOD,
            'rate' => $rate,
            'disabled_months' => [],
            'period' => $period,
        ]);
        /** @var MeterRepoEloquent $meterRepo */
        $meterRepo = app()->make(MeterRepo::class);
        $meterRepo->prepareNextChargeForAllMeters();

        $meter->refresh();
        $this->assertEquals(1, count($meter->mData));
        $mData1 = $meter->mData[0];
        $this->assertNull($mData1->handled_at);
        $this->assertEquals($rate, $mData1->value);
        $this->assertEquals($mData1->charge_at, $meter->created_at->modify($period));

        $mData1->charge_at = $mData1->charge_at->modify($bPeriod)->modify($bPeriod);
        $mData1->handled_at = $mData1->charge_at;
        $mData1->save();
        $meterRepo->prepareNextCharge($meter);
        $meter->refresh();
        $this->assertEquals(2, count($meter->mData));
        $mData2 = $meter->mData[1];
        $this->assertNull($mData2->handled_at);
        $this->assertEquals($rate, $mData1->value);
        $this->assertEquals($mData2->charge_at, $mData1->charge_at->modify($period));

        $mData2->handled_at = $mData2->charge_at;
        $mData2->save();
        $meterRepo->prepareNextChargeForAllMeters();
        $meter->refresh();
        $this->assertEquals(3, count($meter->mData));
        $mData3 = $meter->mData[2];
        $this->assertNull($mData3->handled_at);
        $this->assertEquals($rate, $mData1->value);
        $this->assertEquals($mData3->charge_at, $mData2->charge_at->modify($period));

        $meterRepo->prepareNextChargeForAllMeters();
        $meter->refresh();
        $this->assertEquals(3, count($meter->mData));
    }
}

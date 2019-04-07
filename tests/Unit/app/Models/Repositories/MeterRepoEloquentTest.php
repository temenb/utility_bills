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
    public function testPrepareNextCharge()
    {
        $user = factory(User::class)->create();
        $period = '+1 hour';
        $meter = factory(Meter::class)->create([
            Meter::getOwnerColumn() => $user->id,
            'type' => Meter::ENUM_TYPE_PERIOD,
            'disabled_months' => [],
            'period' => $period,
        ]);
        /** @var MeterRepoEloquent $meterRepo */
        $meterRepo = app()->make(MeterRepo::class);
        $meterRepo->prepareNextChargeForAllMeters();

        $meter->fresh();
        $this->assertEquals(1, count($meter->mData));
        $mData = $meter->mData[0];
        $this->assertNull($mData->handled_at);
        $this->assertEquals($mData->charge_at, $meter->created_at->modify($period));
    }
}

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
     * A basic test example.
     *
     * @return void
     */
    public function testBasic()
    {
        $user = factory(User::class)->create();
        auth()->login($user);
        $meter = factory(Meter::class)->create([
            'type' => Meter::ENUM_TYPE_PERIOD,
            'period' => '+1 hour',
            'disabled_months' => [],
            'rate' => 10,
        ]);

        $this->artisan('command:charge');
        $meterData = MeterData::where('meter_id', '=', $meter->id)->get();
        $this->assertEquals(1, count($meterData));
        //        $this->markTestIncomplete('Command doesnt created yet');
    }
}

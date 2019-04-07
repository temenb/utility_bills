<?php

namespace Tests\Unit\app\Models\Repositories;

use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\MeterRepoEloquent;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MeterRepoEloquentTest extends TestCase
{
//    use DatabaseTransactions;

    /**
     * @throws \Exception
     */
    public function testPrepareNextCharge()
    {
        /** @var MeterRepoEloquent $meterRepo */
        $meterRepo = app()->make(MeterRepo::class);
        $meterRepo->prepareNextChargeForAllMeters();
        $this->markTestSkipped('blah');
    }
}

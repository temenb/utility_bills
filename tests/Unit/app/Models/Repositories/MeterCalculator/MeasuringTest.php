<?php

namespace Tests\Unit\app\Models\Repositories\MeterCalculator;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MeasuringTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasic()
    {
        $this->assertTrue(true);
    }
}

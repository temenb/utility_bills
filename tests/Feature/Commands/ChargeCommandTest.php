<?php

namespace Tests\Unit\app\Models\Repositories\MeterCalculator;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChargeCommandTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasic()
    {
        $this->markTestIncomplete('commant doesnt created yet');
        $this->artisan('command:charge');
    }
}

<?php

namespace Tests\Unit\app\Models\Repositories\MeterCalculator;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Repositories\MeterCalculator\Calculator;
use Tests\Unit\app\Models\Repositories\MeterCalculator\seeds\CalculatorSeeder;

class CalculatorTest extends TestCase
{
//    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasic()
    {
        $this->markTestIncomplete();
        $seeder = new CalculatorSeeder;
        $user = $seeder->run();

    }
}

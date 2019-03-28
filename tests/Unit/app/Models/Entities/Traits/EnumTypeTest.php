<?php

namespace Tests\Unit\app\Models\Repositories\MeterCalculator;

use Tests\TestCase;
use App\Models\Entities\Meter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EnumTypeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasic()
    {
        $enum = Meter::extractEnumType();
        $this->assertNotEmpty($enum);
        $this->assertIsArray($enum);
        $this->assertTrue(in_array(Meter::ENUM_TYPE_MEASURING, $enum));
    }
}

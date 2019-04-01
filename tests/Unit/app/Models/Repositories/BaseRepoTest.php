<?php

namespace Tests\Unit\app\Models\Repositories;

use App\Models\Repositories\MeterRepo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Repositories\BaseRepo;

class BaseRepoTest extends TestCase
{
    use DatabaseTransactions;

    public function testRule()
    {
        $this->assertEquals('', resolve(MeterRepo::class)->rule('lal'));
    }
    public function testRules()
    {
        $this->assertEquals([], resolve(MeterRepo::class)->rules());
    }
}

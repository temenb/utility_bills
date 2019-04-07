<?php

namespace Tests\Unit\app\Models\Repositories;

use App\Models\Repositories\MeterRepo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Repositories\BaseRepo;
use Tests\Unit\app\Models\Repositories\BaseRepo\Inheritor;

class BaseRepoTest extends TestCase
{
    use DatabaseTransactions;

    public function testRule()
    {
        $repo = new Inheritor;
        $this->assertEmpty($repo->rule('fake'));
    }

    public function testRules()
    {
        $repo = new Inheritor;
        $this->assertEmpty($repo->rules('fake'));
    }

    public function testPrepareRules()
    {
        $repo = new Inheritor;
        $this->assertEmpty($repo->alternativeRules());
    }
}

<?php

namespace Tests\Unit\app\Models\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Repositories\BaseRepo;

class BaseRepoTest extends TestCase
{
    public function testRule()
    {
        $this->assertEquals('', BaseRepo::rule('lal'));
    }
    public function testRules()
    {
        $this->assertEquals([], BaseRepo::rules());
    }
}

<?php

namespace Tests\Unit\app\Models\Repositories\MeterCalculator;

use Tests\TestCase;
use App\Models\Entities\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActiveTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDefaultScopeBasic()
    {
        $organization = factory(Organization::class)->create();
        $organization2 = factory(Organization::class)->create();
        $ids = [$organization->id, $organization2->id];
        $organization->disable();
        $organizations = Organization::whereIn('id', $ids)->get();
        $this->assertEquals(1, count($organizations));
        $organizations = Organization::withDisabled()->whereIn('id', $ids)->get();
        $this->assertEquals(2, count($organizations));
        $organizations = Organization::onlyDisabled()->whereIn('id', $ids)->get();
        $this->assertEquals(1, count($organizations));
        $organization->enable();
        $organizations = Organization::whereIn('id', $ids)->get();
        $this->assertEquals(2, count($organizations));
    }
}

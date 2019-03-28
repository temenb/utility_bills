<?php

namespace Tests\Feature\Common;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Entities\User;

class HomeTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasic()
    {
        $response = $this->get('/');
        $response->assertStatus(302);

        $response = $this->actingAs(factory(User::class)->create())->get('/');
        $response->assertStatus(200);

    }
}

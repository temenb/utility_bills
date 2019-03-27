<?php

namespace Tests\Feature\app\Http\Controllers\Bill;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Entities\User;

class BoardControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {

        $response = $this->get('/');

        $response->assertStatus(302);

        auth()->login(factory(User::class)->create());

        $response = $this->get('/');

        $response->assertStatus(200);

    }
}

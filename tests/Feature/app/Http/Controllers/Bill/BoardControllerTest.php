<?php

namespace Tests\Feature\app\Http\Controllers\Bill;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

        $response->assertStatus(200);
    }
}

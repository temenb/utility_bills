<?php
namespace Tests\Feature\Board;

use App\Models\Entities\User;
use Tests\Feature\BrowserKitTestCase as BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BoardTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function testSeeBoard()
    {
        $this->actingAs(factory(User::class)->create())
            ->visit('/')
            ->assertResponseOk();
    }
}
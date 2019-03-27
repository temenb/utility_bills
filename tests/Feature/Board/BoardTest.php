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
        $response = $this->actingAs(factory(User::class)->create())
            ->visit('/')
            ->assertResponseOk()
            ->click('Add Data')
//            ->assert
;
//        $response->assertStatus(200);
//
//        $dom = \phpQuery::newDocument($response->getContent());
//
//        $response->assertSee('table table-bordered')
//            ->assertSee(route('meter.put-data'));

    }

//    public function testDataForm()
//    {
//        $response = $this->actingAs(factory(User::class)->create())->get(route('meter.put-data'));
//
//        $response->assertStatus(200)
//            ->assertSee('<form')
//            ->assertSee(route('meter.put-data'));
//
//    }
}
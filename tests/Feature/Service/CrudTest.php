<?php
namespace Tests\Feature\Service;

use App\Models\Entities\Meter;
use App\Models\Entities\Service;
use App\Models\Entities\User;
use Tests\Feature\BrowserKitTestCase as BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CrudTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function testUpdate()
    {
        $meter = Meter::create();
        $service = Service::create(['name' => 'blah']);
        $name = 'random';
        $this->actingAs(factory(User::class)->create())
            ->post(route('service.crud.update'), [
                'id' => $service->id,
                'meter_id' => $meter->id,
                'name' => $name,
            ])
            ->assertResponseOk();
        $service->refresh();
        $meter->refresh();
        $this->assertEquals($name, $service->name);
        $this->assertEquals($service->id, $meter->service_id);
    }
}
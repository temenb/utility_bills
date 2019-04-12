<?php
namespace Tests\Feature\Organization;

use App\Models\Entities\Meter;
use App\Models\Entities\Organization;
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
        $service = Service::create(['name' => 'blah']);
        $organization = Organization::create(['name' => 'blah']);
        $name = 'random';
        $this->actingAs(factory(User::class)->create())
            ->post(route('organization.crud.update'), [
                'id' => $organization->id,
                'service_id' => $service->id,
                'name' => $name,
            ])
            ->assertResponseOk();
        $organization->refresh();
        $service->refresh();
        $this->assertEquals($name, $organization->name);
        $this->assertEquals($organization->id, $service->organization_id);
    }
}
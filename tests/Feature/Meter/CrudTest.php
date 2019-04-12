<?php
namespace Tests\Feature\Meter;

use App\Models\Entities\Meter;
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
        $name = 'random';
        $rate = 345;
        $type = Meter::ENUM_TYPE_MEASURING;
        $enubPeriod = Meter::enumPeriod();
        $period = array_shift($enubPeriod);
        $this->actingAs(factory(User::class)->create())
            ->post(route('meter.crud.update'), [
                'id' => $meter->id,
                'name' => $name,
                'rate' => $rate,
                'type' => $type,
                'period' => $period,
            ])
            ->assertResponseOk();
        $meter->refresh();
        $this->assertEquals($name, $meter->name);
        $this->assertEquals($rate, $meter->rate);
        $this->assertEquals($type, $meter->type);
        $this->assertEquals(array_search($period, Meter::enumPeriod()), $meter->period);
    }
}
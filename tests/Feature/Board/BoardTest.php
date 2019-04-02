<?php
namespace Tests\Feature\Board;

use App\Models\Entities\User;
use App\Models\Entities\Organization;
use App\Models\Entities\Service;
use App\Http\Requests\Composed\CreateRequest;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\ServiceRepo;
use Faker\Provider\Lorem;
use Faker\Generator;
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

//    /**
//     * Error validations of
//     * required organization name
//     * required service name
//     * required meter name
//     * required rate
//     */
//    public function testBoardValidationErrorsBunch1()
//    {
//        $user = factory(User::class)->create();
//        auth()->login($user);
//        $organization = factory(Organization::class)->create();
//        $service = factory(Service::class)->make();
//        $organization->services()->save($service);
//
//        $page = $this->visit(route('board.form'));
//
//        $page->select(ServiceRepo::NEW_ORGANIZATION, 'organization_id')
//            ->type('', 'organization[name]')
//            ->select(MeterRepo::NEW_SERVICE, 'service_id')
//            ->type('', 'service[name]')
//            ->press('Submit');
//        $page->see('The name field is required.')
//            ->see('The rate field is required.');
//    }
//
//    /**
//     * Error validations of
//     * type of rate
//     */
//    public function testBoardValidationErrorsBunch2()
//    {
//
//        $user = factory(User::class)->create();
//        auth()->login($user);
//        $organization = factory(Organization::class)->create();
//        $service = factory(Service::class)->make();
//        $organization->services()->save($service);
//
//        $page = $this->visit(route('board.form'));
//
//        $page->type('0sd', 'rate')
//            ->press('Submit');
//
//        $page->see('The rate format is invalid.');
//
//    }
//
//    /**
//     * Error validations of
//     * empty service name
//     */
//    public function testBoardValidationErrorsBunch3()
//    {
//
//        $user = factory(User::class)->create();
//        auth()->login($user);
//        $organization = factory(Organization::class)->create();
//        $service = factory(Service::class)->make();
//        $organization->services()->save($service);
//
//        $page = $this->visit(route('board.form'));
//
//        $page->select(ServiceRepo::NEW_ORGANIZATION, 'organization_id')
//            ->type('random string', 'organization[name]')
//            ->select($service->id, 'service_id')
//            ->type('', 'service[name]')
//            ->type('random string', 'name')
//            ->type(1234, 'rate')
//            ->press('Submit');
//
//        $page->see('Meter was created successfully.');
//
//    }
//
//    public function testBoardForm()
//    {
//        $page = $this->actingAs(factory(User::class)->create())->visit(route('board.form'));
//
//        $faker = new Lorem(new Generator);
//        $organizationName = $faker->text(10);
//        $serviceName = $faker->text(10);
//        $meterName = $faker->text(10);
//        $rate = rand(1, 99999);
//
//        $page->type($organizationName, 'organization[name]')
//            ->type($serviceName, 'service[name]')
//            ->type($meterName, 'name')
//            ->type($rate, 'rate')
//            ->press('Submit')
//        ;
//
//        $page->see('Meter was created successfully.');
//
//        $page->visit('/')
//            ->see($organizationName)
//            ->see($serviceName)
////            ->see($meterName)
//            ->see($rate)
//        ;
//    }
}
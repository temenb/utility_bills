<?php

use Illuminate\Database\Seeder;
use App\Entities\Organization;
use App\Entities\Service;
use App\Entities\Meter;
use App\Entities\MeterValue;
use App\Entities\Account;
use App\Entities\User;
use Illuminate\Database\Eloquent\Model;

class TestUserWithEntitiesFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eUserCreator = $this->createUser();
        $this->createOrganizations($eUserCreator);
    }

    /**
     * @return User
     */
    private function createUser()
    {
        $name = 'test';
        $eUser = User::where('name', '=', $name)->first();
        if (!$eUser) {
            $eUser = factory(User::class)->make();
            $eUser->setAttribute('name', $name)->setAttribute('email', $name . '@example.net')->save();
        }
        return $eUser;
    }

    /**
     * @param User $eUserCreator
     * @return mixed
     */
    private function createOrganizations(User $eUserCreator) {
        return factory(Organization::class, 2)->create()
            ->each($this->addCreatorToEntity($eUserCreator))
            ->each($this->addServicesToOrganization())
            ->each($this->addAccountsToOrganization());
    }

    /**
     * @return Closure
     */
    private function addServicesToOrganization() {
        return function (Organization $organization) {
            $organization->services()->saveMany(factory(Service::class, 2)->make());
            $organization->services()->each($this->addCreatorToEntity($organization->creator));
            $organization->services()->each($this->addMeterToServices());
        };
    }

    /**
     * @return Closure
     */
    private function addAccountsToOrganization () {
        return function (Organization $organization) {
            $organization->accounts()->saveMany(factory(Account::class, 2)->make());
            $organization->accounts()->each($this->addCreatorToEntity($organization->creator));
        };
    }

    /**
     * @return Closure
     */
    private function addMeterToServices() {
        return function (Service $service) {
            $service->meters()->saveMany(factory(Meter::class, 2)->make());
            $service->meters()->each($this->addCreatorToEntity($service->creator));
            $service->meters()->each($this->addMeterValuesToMeter());
        };
    }

    /**
     * @return Closure
     */
    private function addMeterValuesToMeter() {
        return function (Meter $meter) {
            $meter->meterValues()->saveMany(factory(MeterValue::class, 2)->make());
            $meter->meterValues()->each($this->addCreatorToEntity($meter->creator));
        };
    }

    /**
     * @param User $eCreator
     * @return Closure
     */
    private function addCreatorToEntity(User $eCreator) {
        return function (Model $entity) use ($eCreator) {
            $entity->creator()->associate($eCreator);
            $entity->save();
        };
    }
}

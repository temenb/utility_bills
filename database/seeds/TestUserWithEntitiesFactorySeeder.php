<?php

use Illuminate\Database\Seeder;
use App\Entities\Organization;
use App\Entities\Service;
use App\Entities\Meter;
use App\Entities\MeterValue;
use App\Entities\Account;
use App\Entities\User;
use App\Entities\ServiceValue;
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
        $owner = $this->createUser();
        $this->createOrganizations($owner);
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
            $eUser->setAttribute('name', $name)
                ->setAttribute('email', $name . '@example.net')
                ->setAttribute('password', bcrypt(strrev($name)))->save();
        }
        return $eUser;
    }

    /**
     * @param User $owner
     * @return mixed
     */
    private function createOrganizations(User $owner) {
        return factory(Organization::class, 2)->create()
            ->each($this->setEntityOwner($owner))
            ->each($this->addServicesToOrganization())
            ->each($this->addAccountsToOrganization());
    }

    /**
     * @return Closure
     */
    private function addServicesToOrganization() {
        return function (Organization $organization) {
            $organization->services()->saveMany(factory(Service::class, 2)->make());
            $organization->services()->each($this->setEntityOwner($organization->owner));
            $organization->services()->each($this->addMeterToServices());
            $organization->services()->each($this->addServiceValuesToServices());
        };
    }

    /**
     * @return Closure
     */
    private function addAccountsToOrganization () {
        return function (Organization $organization) {
            $organization->accounts()->saveMany(factory(Account::class, 2)->make());
            $organization->accounts()->each($this->setEntityOwner($organization->owner));
        };
    }

    /**
     * @return Closure
     */
    private function addMeterToServices() {
        return function (Service $service) {
            $service->meters()->saveMany(factory(Meter::class, 2)->make());
            $service->meters()->each($this->setEntityOwner($service->owner));
            $service->meters()->each($this->addMeterValuesToMeter());
        };
    }

    /**
     * @return Closure
     */
    private function addMeterValuesToMeter() {
        return function (Meter $meter) {
            $meter->meterValues()->saveMany(factory(MeterValue::class, 2)->make());
            $meter->meterValues()->each($this->setEntityOwner($meter->owner));
        };
    }

    /**
     * @return Closure
     */
    private function addServiceValuesToServices() {
        return function (Service $service) {
            $service->serviceValues()->saveMany(factory(ServiceValue::class, 2)->make());
            $service->serviceValues()->each($this->setEntityOwner($service->owner));
        };
    }

    /**
     * @param User $owner
     * @return Closure
     */
    private function setEntityOwner(User $owner) {
        return function (Model $entity) use ($owner) {
            $entity->owner()->associate($owner);
            $entity->save();
        };
    }
}

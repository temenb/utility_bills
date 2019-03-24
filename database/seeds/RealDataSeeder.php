<?php

use Illuminate\Database\Seeder;
use App\Models\Entities\Organization;
use App\Models\Entities\Service;
use App\Models\Entities\Meter;
use App\Models\Entities\MeterValue;
use App\Models\Entities\Account;
use App\Models\Entities\User;
use App\Models\Entities\ServiceValue;
use Illuminate\Database\Eloquent\Model;

class RealDataSeeder extends Seeder
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
        $name = 'temenb';

        $eUser = User::where('name', '=', $name)->first();
        if (!$eUser) {
            $eUser = factory(User::class)->make();
            $eUser->setAttribute('name', $name)
                ->setAttribute('email', 'temenb@gmail.com')
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

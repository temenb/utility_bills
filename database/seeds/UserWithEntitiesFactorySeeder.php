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

class UserWithEntitiesFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createOwnerUser();
        $this->createOrganizations();
    }

    /**
     * @return mixed
     */
    private function createOrganizations() {
        return factory(Organization::class, 2)->create()
            ->each($this->addServicesToOrganization())
            ->each($this->addAccountsToOrganization());
    }

    /**
     * @return Closure
     */
    private function addServicesToOrganization() {
        return function (Organization $organization) {
            $organization->services()->saveMany(factory(Service::class, 2)->make());
            $organization->services()->each($this->addMeterToServices());
        };
    }

    /**
     * @return Closure
     */
    private function addAccountsToOrganization () {
        return function (Organization $organization) {
            $organization->accounts()->saveMany(factory(Account::class, 2)->make());
        };
    }

    /**
     * @return Closure
     */
    private function addMeterToServices() {
        return function (Service $service) {
            $service->meters()->saveMany(factory(Meter::class, 2)->make());
            $service->meters()->each($this->addMeterValuesToMeter());
        };
    }

    /**
     * @return Closure
     */
    private function addMeterValuesToMeter() {
        return function (Meter $meter) {
            $meter->meterValues()->saveMany(factory(MeterValue::class, 2)->make());
        };
    }

    private function createOwnerUser()
    {
        Auth::login(factory(User::class)->create());
    }
}

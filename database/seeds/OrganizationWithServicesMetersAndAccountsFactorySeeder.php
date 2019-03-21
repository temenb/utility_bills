<?php

use Illuminate\Database\Seeder;
use App\Entities\Organization;
use App\Entities\Service;
use App\Entities\Meter;
use App\Entities\MeterValue;
use App\Entities\Account;
use App\Entities\User;

class OrganizationWithServicesMetersAndAccountsFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 'temenb')->create();
//        factory(Organization::class, 2)->create()
//            ->each($this->addServicesToOrganization())
//            ->each($this->addAccountsToOrganization());
    }

    /**
     * @return Closure
     */
    private function addServicesToOrganization () {
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
}

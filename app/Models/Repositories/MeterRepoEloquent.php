<?php

namespace App\Models\Repositories;

use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;
use App\Models\Entities\MeterDebt;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use mysql_xdevapi\Exception;

/**
 * Class MeterRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
class MeterRepoEloquent extends MeterRepo
{
    const EMPTY_SERVICE_ID = 0;
    const EMPTY_ORGANIZATION_ID = 0;

    /**
     * @param null|int|User $user
     * @return mixed
     * @throws \Exception
     */
    public function getMeterWithAllDataByUser($user = null)
    {
        $userId = resolve(UserRepo::class)->extractUserId($user);
        $meters = Meter::with('service', 'service.organization')
            ->with([
                'mData' => function ($query) {
                    $query->whereIn('position', [MeterData::ENUM_POSITION_CURRENT, MeterData::ENUM_POSITION_FUTURE]);
                },
                'mDebts' => function ($query) {
                    $query->whereIn('position', [MeterDebt::ENUM_POSITION_CURRENT, MeterDebt::ENUM_POSITION_FUTURE]);
                },
            ])
            ->where('owner_id', '=', $userId)
            ->get();
        return $meters;
    }

    /**
     * @param $meters
     * @return array
     */
    public function reRangeData($meters): array
    {
        $organization = [];
//
//        foreach ($meters as $meter) {
//            $serviceId = self::EMPTY_SERVICE_ID;
//            $organizationId = self::EMPTY_ORGANIZATION_ID;
//            if ($meter->service_id) {
//                $serviceId = $meter->service_id;
//                if ($meter->service->organization_id) {
//                    $organizationId = $meter->service->organization_id;
//                }
//            }
//            $organization += [$organizationId => ['rowspan' => 0, 'data' => []]];
//            $organization[$organizationId]['rowspan']++;
//            $organization[$organizationId]['data'] += [$serviceId => ['rowspan' => 0]];
//            $organization[$organizationId]['data'][$serviceId]['rowspan']++;
//            $organization[$organizationId]['data'][$serviceId]['data'][] = $meter;
//        }
        return $organization;
    }

    /**
     *
     */
    public function prepareNextChargeForAllMeters() {
        $meters = Meter::whereDoesntHave('mData', function(Builder $query) {
            $query->whereNull('handled_at');
        })->get();
        $this->prepareNextCharge($meters);
    }

    /**
     * @param $meters
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function prepareNextCharge($meters)
    {
        if (!is_iterable($meters)) {
            $meters = new Collection([$meters]);
        }
        /** @var MeterDataRepoEloquent $meterDataRepo */
        $meterDataRepo = app()->make(MeterDataRepo::class);
        foreach ($meters as $meter) {
            $meterDataRepo->prepareNextCharge($meter);
        }
    }
}

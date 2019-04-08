<?php

namespace App\Models\Repositories;

use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;
use App\Models\Entities\User;
use DateTime;
use Illuminate\Support\Facades\DB;

/**
 * Class MeterDataRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
class MeterDataRepoEloquent extends MeterDataRepo
{
    /**
     * @param DateTime|null $date
     * @return MeterData[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllForCharging(DateTime $date = null)
    {
        $date = $date ?? now();
        return MeterData::whereNull('handled_at')->where('charge_at', '<=', $date)->get();
    }

    /**
     * @param Meter $meter
     * @throws \Exception
     */
    public function prepareNextCharge(Meter $meter)
    {
        if (Meter::ENUM_TYPE_MEASURING != $meter->type) {
            MeterData::create([
                'meter_id' => $meter->id,
                'value' => $meter->rate,
                'position' => MeterData::ENUM_POSITION_FUTURE,
                MeterData::getOwnerColumn() => $meter->{Meter::getOwnerColumn()},
                'charge_at' => $this->calculateNextChargeDate($meter),
            ]);
        }
    }

    /**
     * @param Meter $meter
     * @return \DateTime
     * @throws \Exception
     */
    public function calculateNextChargeDate(Meter $meter)
    {
        $lastMeterData = $this->getCurrentChagreData($meter);
        $resultDate = optional($lastMeterData)->charge_at ?? $meter->created_at;
        $resultDate->modify($meter->period);
        return $resultDate;
    }

    /**
     * @param Meter $meter
     * @return MeterData | null
     */
    public function getCurrentChagreData(Meter $meter)
    {
        return $meter->mData()
//            ->whereNotNull('handled_at')
//            ->where('owner_id', '=', $meter->getAttribute('owner_id'))
            ->where('position', MeterData::ENUM_POSITION_CURRENT)->first();
    }

    /**
     * @param MeterData $meterData
     */
    public function movePositionForward(MeterData $meterData): void
    {
        DB::table(with(new MeterData)->getTable())
            ->where('position', MeterData::ENUM_POSITION_CURRENT)
            ->where('meter_id', $meterData->meter_id)
            ->update(['position' => MeterData::ENUM_POSITION_PAST]);

        $meterData->handled_at = now();
        $meterData->position = MeterData::ENUM_POSITION_CURRENT;
        $meterData->save();
    }
}

<?php

namespace App\Models\Repositories;

use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;
use DateTime;
use Illuminate\Support\Facades\DB;

/**
 * Class MeterDataRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
class MeterDataRepoEloquent extends MeterDataRepo
{
//    /**
//     * @param Meter $meter
//     * @return mixed
//     */
//    public function getLastMData(Meter $meter)
//    {
//        $lastMData = MeterData::where('last', '=', 1)
//            ->where('owner_id', '=', $meter->getAttribute('owner_id'))
//            ->where('meter_id', '=', $meter->getAttribute('id'))
//            ->orderBy('id', 'desc')
//            ->first();
//        return $lastMData;
//    }
//
//    /**
//     * @param Meter $meter
//     * @param null $lastMDataId
//     * @return mixed
//     */
//    public function getNewMData(Meter $meter, $lastMDataId = null)
//    {
//        if (is_null($lastMDataId)) {
//            $lastMData = $this->getLastMData($meter);
//            $lastMDataId = $lastMData ? $lastMData->getAttribute('id') : 0;
//
//        }
//        $lastMData = MeterData::where('last', '=', 0)
//            ->where('owner_id', '=', $meter->getAttribute('owner_id'))
//            ->where('meter_id', '=', $meter->getAttribute('id'))
//            ->where('id', '>', $lastMDataId)
//            ->orderBy('id', 'desc')
//            ->first();
//        return $lastMData;
//    }

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
            DB::transaction(function() use ($meter) {
                $nextChargeDate = $this->calculateNextChargeDate($meter);

                DB::table(with(new MeterData)->getTable())
                    ->where('last', 1)
                    ->where('meter_id', $meter->id)
                    ->update(['last' => 0]);

                MeterData::create([
                    'meter_id' => $meter->id,
                    'value' => $meter->rate,
                    'last' => 1,
                    MeterData::getOwnerColumn() => $meter->{Meter::getOwnerColumn()},
                    'charge_at' => $nextChargeDate
                ]);
            });
        }
    }

    /**
     * @param Meter $meter
     * @return \DateTime
     * @throws \Exception
     */
    public function calculateNextChargeDate(Meter $meter)
    {
        $lastMeterData = $this->getLastChagreData($meter);
        $resultDate = optional($lastMeterData)->charge_at ?? $meter->created_at;
        $resultDate->modify($meter->period);
        return $resultDate;
    }

    /**
     * @param Meter $meter
     * @return MeterData | null
     */
    public function getLastChagreData(Meter $meter)
    {
        return $meter->mData()->whereNotNull('handled_at')
//            ->where('owner_id', '=', $meter->getAttribute('owner_id'))
            ->where('last', 1)->first();
    }
}

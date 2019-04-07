<?php

namespace App\Models\Repositories;

use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;

/**
 * Class MeterDataRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
class MeterDataRepoEloquent extends MeterDataRepo
{
    /**
     * @param Meter $meter
     * @return mixed
     */
    public function getLastMData(Meter $meter)
    {
        $lastMData = MeterData::where('last', '=', 1)
            ->where('owner_id', '=', $meter->getAttribute('owner_id'))
            ->where('meter_id', '=', $meter->getAttribute('id'))
            ->orderBy('id', 'desc')
            ->first();
        return $lastMData;
    }

    /**
     * @param Meter $meter
     * @param null $lastMDataId
     * @return mixed
     */
    public function getNewMData(Meter $meter, $lastMDataId = null)
    {
        if (is_null($lastMDataId)) {
            $lastMData = $this->getLastMData($meter);
            $lastMDataId = $lastMData ? $lastMData->getAttribute('id') : 0;

        }
        $lastMData = MeterData::where('last', '=', 0)
            ->where('owner_id', '=', $meter->getAttribute('owner_id'))
            ->where('meter_id', '=', $meter->getAttribute('id'))
            ->where('id', '>', $lastMDataId)
            ->orderBy('id', 'desc')
            ->first();
        return $lastMData;
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
                MeterData::getOwnerColumn() => $meter->{Meter::getOwnerColumn()},
                'charge_at' => $this->calculateNextChargeDate($meter)
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
        $lastMeterData = $this->getLastChagreData($meter);
        if ($lastMeterData) {
            $resultDate = $lastMeterData->charge_at;
            $resultDate->modify($meter->period);
        } else {
            $resultDate = $meter->created_at;
        }
        return $resultDate;
    }

    /**
     * @param Meter $meter
     * @return MeterData | null
     */
    public function getLastChagreData(Meter $meter)
    {
        return $meter->mData()->whereNotNull('handled_at')
            ->orderBy('handled_at', 'desc')->first();///@TODO update with column 'last' in future for performance purpose
    }
}

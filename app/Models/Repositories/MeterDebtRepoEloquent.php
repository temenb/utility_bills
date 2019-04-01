<?php

namespace App\Models\Repositories;

use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;
use App\Models\Entities\MeterDebt;

/**
 * Class AccountRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
class MeterDebtRepoEloquent extends MeterDebtRepo
{
    /**
     * @return array
     */
    public function calculators()
    {
        return $this->_calculators;
    }

    /**
     * @param MeterData $newMData
     * @param $lastMData
     * @param Meter|null $meter
     * @return mixed
     */
    public function makeNewMDebt(MeterData $newMData, $lastMData, Meter $meter = null)
    {
        if (!$meter) {
            $meter = $newMData->meter;
        }
        $newDebt = $this->calculateNewDebt($newMData, $lastMData, $meter);
        $totalDebt = $this->calculateTotalDebt($meter, $newDebt);
        $newMDebt = MeterDebt::make([
            'meter_data_id' => $newMData->getAttribute('id'),
            'meter_id' => $newMData->getAttribute('meter_id'),
            'value' => $totalDebt,
            'last' => 1,
            'owner_id' => $newMData->getAttribute('owner_id'),
        ]);
        return $newMDebt;
    }

    /**
     * @param MeterData $newMData
     * @param MeterData $lastMData
     * @param Meter $meter
     * @return mixed
     */
    public function calculateNewDebt(MeterData $newMData, $lastMData, $meter)
    {



        $newMeterValue = $newMData->getAttribute('value');
        $prevMeterValue = optional($lastMData)->value ?? 0;
        $rate = $meter->getRateType();
        $newDebt = $this->applyDebtFormula($rate, $newMeterValue, $prevMeterValue);
        return $newDebt;
    }

    /**
     * @param $rate
     * @param $newMeterValue
     * @param $prevMeterValue
     * @return float|int
     */
    public function applyDebtFormula($rate, $newMeterValue, $prevMeterValue)
    {
        return $rate*($newMeterValue - $prevMeterValue);
    }

    /**
     * @param Meter $meter
     * @param $newDebt
     * @return int
     */
    public function calculateTotalDebt(Meter $meter, $newDebt): int
    {
        $prevMDept = $meter->mDebts()->orderBy('created_at', 'desc')->first();
        $prevDeptValue = optional($prevMDept)->value ?? 0;
        $totalDebt = $prevDeptValue + $newDebt;
        return $totalDebt;
    }
}

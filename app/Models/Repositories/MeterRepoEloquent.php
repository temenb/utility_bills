<?php

namespace App\Models\Repositories;

use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;
use App\Models\Entities\MeterDebt;
use Illuminate\Support\Facades\DB;

/**
 * Class MeterRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
class MeterRepoEloquent extends MeterRepo
{
    private $_calculators = [
        Meter::ENUM_TYPE_DAILY => MeterCalculator\Calculator::class,
        Meter::ENUM_TYPE_WEEKLY => MeterCalculator\Calculator::class,
        Meter::ENUM_TYPE_MONTHLY => MeterCalculator\Calculator::class,
        Meter::ENUM_TYPE_QUARTERLY => MeterCalculator\Calculator::class,
        Meter::ENUM_TYPE_ANNUALLY => MeterCalculator\Calculator::class,
        Meter::ENUM_TYPE_MEASURING => MeterCalculator\Calculator::class,
    ];

    /**
     * @return array
     */
    public function calculators()
    {
        return $this->_calculators;
    }

    /**
     * @param Meter $meter
     */
    public function reCalculateDept(Meter $meter)
    {
        /** @var MeterData $newMData */
        $newMData = $meter->mData()
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->first();
        if (!$newMData->getAttribute('handled_at')) {
            /** @var MeterData $newMData */
            $mData = $meter->mData()->whereNotNull('handled_at')
                ->orderBy('created_at', 'desc')->first();
            $newMeterValue = $newMData->getAttribute('value');
            $prevMeterValue = $mData ? $mData->getAttribute('value') : 0;
            $rate = $meter->getAttribute('rate');
            $newDebt = $this->calculateNewDept($rate, $newMeterValue, $prevMeterValue);
            $prevMDept = $meter->mDebts()->orderBy('created_at', 'desc')->first();
            $prevDeptValue = $prevMDept ? $prevMDept->getAttribute('value') : 0;
            $totalDebt = $prevDeptValue + $newDebt;

            DB::transaction(function() use ($newMData, $totalDebt) {
                $newMData->setAttribute('handled_at', now())
                    ->save();
                MeterDebt::create([
                    'meter_data_id' => $newMData->getAttribute('id'),
                    'meter_id' => $newMData->getAttribute('meter_id'),
                    'value' => $totalDebt,
                    'owner_id' => $newMData->getAttribute('owner_id'),
                ]);
            });
        }
    }

    /**
     * @param $rate
     * @param $newMeterValue
     * @param $prevMeterValue
     * @return float|int
     */
    private function calculateNewDept($rate, $newMeterValue, $prevMeterValue)
    {
        return $rate*($newMeterValue - $prevMeterValue);
    }
}

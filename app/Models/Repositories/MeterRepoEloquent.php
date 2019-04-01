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
        /** @var MeterDataRepoEloquent $mDataRepo */
        $mDataRepo = resolve(MeterDataRepo::class);

        /** @var MeterDebtRepoEloquent $mDataRepo */
        $mDeptRepo = resolve(MeterDebtRepo::class);

        $lastMData = $mDataRepo->getLastMData($meter);
        $newMData = $mDataRepo->getNewMData($meter, optional($lastMData)->id ?? 0);

        if ($newMData) {
            $newMDebt = $mDeptRepo->makeNewMDebt($newMData, $lastMData, $meter);

            DB::transaction(function() use ($newMData, $newMDebt) {
                MeterData::where('last', '=', 1)->update(['last' => 0]);
                MeterDebt::where('last', '=', 1)->update(['last' => 0]);
                $newMData->setAttribute('last', 1)
                    ->save();
                $newMDebt->save();
            });
        }
    }
}

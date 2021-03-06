<?php

namespace App\Models\Repositories;

use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;
use App\Models\Entities\MeterDebt;
use Illuminate\Support\Facades\DB;

/**
 * Class AccountRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
class MeterDebtRepoEloquent extends MeterDebtRepo
{
    /**
     * @param MeterData $meterData
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function charge(MeterData $meterData)
    {
        /** @var MeterDataRepoEloquent $meterDataRepo */
        $meterDataRepo = app()->make(MeterDataRepo::class);
        DB::transaction(function() use ($meterData, $meterDataRepo) {

            $meterDataRepo->movePositionForward($meterData);

            $newDebtValue = $this->currentValue($meterData) + $meterData->value;

            DB::table(with(new MeterDebt)->getTable())
                ->where('position', MeterDebt::ENUM_POSITION_CURRENT)
                ->where('meter_id', $meterData->meter_id)
                ->update(['position' => MeterDebt::ENUM_POSITION_PAST]);

            MeterDebt::create([
                MeterDebt::getOwnerColumn() => $meterData->{MeterData::getOwnerColumn()},
                'meter_data_id' => $meterData->id,
                'meter_id' => $meterData->meter_id,
                'value' => $newDebtValue,
                'position' => MeterDebt::ENUM_POSITION_CURRENT,
            ]);
        });
    }

    public function currentValue(MeterData $meterData)
    {
        $meterDebt = MeterDebt::where('meter_id', $meterData->meter_id)
            ->where('position', MeterDebt::ENUM_POSITION_CURRENT)
            ->first();
        return (int) optional($meterDebt)->value;
    }
}

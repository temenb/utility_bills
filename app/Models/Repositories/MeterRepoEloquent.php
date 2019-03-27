<?php

namespace App\Models\Repositories;

use App\Models\Entities\Meter;

/**
 * Class MeterRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
class MeterRepoEloquent extends MeterRepo
{
    private $_calculators = [
        Meter::ENUM_TYPE_HOURLY => MeterCalculator\Calculator::class,
        Meter::ENUM_TYPE_DAILY => MeterCalculator\Calculator::class,
        Meter::ENUM_TYPE_WEEKLY => MeterCalculator\Calculator::class,
        Meter::ENUM_TYPE_MONTHLY => MeterCalculator\Calculator::class,
        Meter::ENUM_TYPE_QUARTERLY => MeterCalculator\Calculator::class,
        Meter::ENUM_TYPE_ANNUALLY => MeterCalculator\Calculator::class,
        Meter::ENUM_TYPE_MEASURING => MeterCalculator\Calculator::class,
    ];

    public function calculateDebt(Meter $meter) {
        dd($this->_calculators);//TODO Don't forget to remove.
        $meter->lastMeterValue();

    }
}

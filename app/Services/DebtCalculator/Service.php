<?php

namespace App\Services\DebtCalculator;

class Service extends \Illuminate\Support\ServiceProvider implements IDebtCalculator
{
    /**
     * @param int   $oldValue
     * @param int   $newValue
     * @param int   $price
     * @param int   $month
     * @param int[] $disabledMonths
     * @param int   $debt
     *
     * @return int
     */
    public function calculate(
        int $oldValue,
        int $newValue,
        int $price,
        int $month,
        array $disabledMonths,
        int $debt = 0
    ): int
    {
        $result = $debt;
        if (!in_array($month, $disabledMonths)) {
            $result += ($newValue - $oldValue) * $price;
        }

        return $result;
    }

    public function register() {}
}

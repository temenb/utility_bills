<?php

namespace App\Services\DebtCalculator;

Interface IDebtCalculator
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
    ): int;
}

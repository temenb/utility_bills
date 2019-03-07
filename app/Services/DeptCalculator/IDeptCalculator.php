<?php

namespace App\Services\DeptCalculator;

Interface IDeptCalculator
{
    /**
     * @param int   $oldValue
     * @param int   $newValue
     * @param int   $price
     * @param int   $month
     * @param int[] $disabledMonths
     * @param int   $dept
     *
     * @return int
     */
    public function calculateDept(
        int $oldValue,
        int $newValue,
        int $price,
        int $month,
        array $disabledMonths,
        int $dept = 0
    ): int;
}

<?php

namespace App\Services\DeptCalculator;

class Service extends \Illuminate\Support\ServiceProvider implements IDeptCalculator
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
    ): int
    {
        $result = $dept;
        if (!in_array($month, $disabledMonths)) {
            $result += ($newValue - $oldValue) * $price;
        }

        return $result;
    }

    public function register() {}
}

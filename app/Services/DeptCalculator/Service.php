<?php

namespace App\Services\DeptCalculator;

class Service implements IDeptCalculator
{
    /**
     * @param int $oldValue
     * @param int $newValue
     * @param int $price
     * @param \DateTime $from
     * @param \DateTime $to
     * @param int $dept
     *
     * @return int
     */
    public function calculateDept(
        int $oldValue,
        int $newValue,
        int $price,
        \DateTime $from,
        \DateTime $to,
        int $dept = 0
    ): int
    {
        return $dept;
    }
}

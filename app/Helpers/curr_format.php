<?php

if (! function_exists('curr_format')) {
    /**
     * @param int $value
     * @return string
     */
    function curr_format(int $value)
    {
        return number_format($value/100, 2);
    }
}

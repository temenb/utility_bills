
<?php

use Faker\Generator as Faker;
use App\Entities\Meter;

$factory->define(Meter::class, function (Faker $faker) {
    $rangeLength = rand(0, 5);
    $rangeFrom = rand(1, 12 - $rangeLength);
    $range = $rangeLength ? range($rangeFrom, $rangeFrom + $rangeLength) : [];
    return [
        'value' => $faker->randomDigitNotNull,
        'type' => $faker->randomElement(Meter::ENUM_TYPE),
        'disabled_months' => json_encode($range),
    ];
});

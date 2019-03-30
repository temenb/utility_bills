
<?php

use Faker\Generator as Faker;
use App\Models\Entities\Meter;

$factory->define(Meter::class, function (Faker $faker) {
    $rangeLength = rand(0, 5);
    $rangeFrom = rand(1, 12 - $rangeLength);
    $range = $rangeLength ? range($rangeFrom, $rangeFrom + $rangeLength) : [];
    return [
        'rate' => $faker->randomDigitNotNull,
        'name' => $faker->company,
        'type' => $faker->randomElement(Meter::enumType()),
        'disabled_months' => json_encode($range),
    ];
});

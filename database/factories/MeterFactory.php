
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
        'period' => $faker->randomElement(
            ['+1 minute', '+1 hour', '+1 day', '+1 week', '+1 month', '+3 month', '+1 year']
        ),
//        'period' => 'asdfadsf',
        'type' => $faker->randomElement(Meter::enumType()),
        'disabled_months' => $range,
    ];
});

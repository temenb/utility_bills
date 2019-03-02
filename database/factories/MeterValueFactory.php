
<?php

use Faker\Generator as Faker;
use App\Models\MeterValue;

$factory->define(MeterValue::class, function (Faker $faker) {
    return [
        'value' => $faker->randomDigitNotNull,
    ];
});

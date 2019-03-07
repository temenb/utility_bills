
<?php

use Faker\Generator as Faker;
use App\Entities\Meter;

$factory->define(Meter::class, function (Faker $faker) {
    return [
        'value' => $faker->randomDigitNotNull,
        'type' => $faker->randomElement(Meter::ENUM_TYPE),
    ];
});

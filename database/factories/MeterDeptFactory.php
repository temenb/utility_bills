
<?php

use Faker\Generator as Faker;
use App\Models\Entities\MeterDebt;

$factory->define(MeterDebt::class, function (Faker $faker) {
    return [
        'value' => $faker->randomDigitNotNull,
    ];
});

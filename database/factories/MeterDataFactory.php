
<?php

use Faker\Generator as Faker;
use App\Models\Entities\MeterData;

$factory->define(MeterData::class, function (Faker $faker) {
    return [
        'value' => $faker->randomDigitNotNull,
    ];
});

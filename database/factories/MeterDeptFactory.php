
<?php

use Faker\Generator as Faker;
use App\Models\Entities\MeterDept;

$factory->define(MeterDept::class, function (Faker $faker) {
    return [
        'value' => rand(0, 100000),
    ];
});

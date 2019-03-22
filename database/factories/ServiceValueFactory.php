
<?php

use App\Entities\ServiceValue;
use Faker\Generator as Faker;

$factory->define(ServiceValue::class, function (Faker $faker) {
    return [
        'value' => 0,
    ];
});

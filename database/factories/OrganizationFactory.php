<?php

use Faker\Generator as Faker;
use App\Entities\Organization;

$factory->define(Organization::class, function (Faker $faker) {
    return [
        'name' => $faker->company
    ];
});

<?php

use Faker\Generator as Faker;
use App\Models\Entities\Organization;

$factory->define(Organization::class, function (Faker $faker) {
    return [
        'name' => $faker->company
    ];
});

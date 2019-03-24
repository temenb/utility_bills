
<?php

use App\Models\Entities\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'name' => Str::random(10),
    ];
});

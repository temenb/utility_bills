
<?php

use Faker\Generator as Faker;
use App\Entities\Account;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'value' => rand(0, 100000),
    ];
});

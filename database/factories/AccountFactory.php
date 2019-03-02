
<?php

use Faker\Generator as Faker;
use App\Models\Account;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'value' => 0,
    ];
});

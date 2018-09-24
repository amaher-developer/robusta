<?php

use Faker\Generator as Faker;

$factory->define(\App\Employee::class, function (Faker $faker) {
    return [
        'department_id' => 1,
        'name' => $faker->name,
        'salary' => $faker->biasedNumberBetween(1000,20000),
        'bonus_by_ratio' => 10
    ];
});

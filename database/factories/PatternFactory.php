<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Pattern;
use Faker\Generator as Faker;

$factory->define(Pattern::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'moves' => $faker->numberBetween(19, 62),
        'interpretation' => $faker->paragraph,
    ];
});

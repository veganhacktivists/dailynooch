<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Fact;
use Faker\Generator as Faker;

$factoryFunction = function (Faker $faker) {
    return [
        'text' => $faker->text(),
    ];
};

$factory->define(Fact::class, $factoryFunction);

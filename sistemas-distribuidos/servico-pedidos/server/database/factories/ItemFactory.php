<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'nome' => $faker->languageCode,
        'descricao' => $faker->paragraph,
        'preco' => $faker->randomFloat(2, 1, 15)
    ];
});

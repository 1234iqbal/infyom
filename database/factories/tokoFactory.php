<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\toko;
use Faker\Generator as Faker;

$factory->define(toko::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'id_user' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});

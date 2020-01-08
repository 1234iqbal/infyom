<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\databuku;
use Faker\Generator as Faker;

$factory->define(databuku::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'alamat' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});

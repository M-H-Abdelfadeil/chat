<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'=>$faker->word(5),
        'description'=>$faker->paragraph(6),
        'price'=>$faker->numberBetween(1,1000),
    ];
});

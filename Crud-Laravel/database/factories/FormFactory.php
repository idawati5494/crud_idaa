<?php

use Faker\Generator as Faker;



$factory->define(App\Form::class, function (Faker $faker) {
    static $password;

    return [
        'title' => $faker->title,
        'desc' => $faker->desc,
        'table'=>$faker->timestamps,
    ];
});

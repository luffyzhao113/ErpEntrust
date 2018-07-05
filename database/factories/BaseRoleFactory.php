<?php
use Faker\Generator as Faker;

$factory->define(App\Model\BaseAdmin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('123123'),
        'remember_token' => str_random(10),
        'photo' => $faker->imageUrl(400, 400)
    ];
});

$factory->define(App\Model\BaseRole::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->city,
        'description' => str_random(10),
    ];
});

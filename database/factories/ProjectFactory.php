<?php

use Faker\Generator as Faker;

$factory->define(\App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'type' => collect(['internal', 'external'])->random(),
        'repository' => $faker->url
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(\App\Server::class, function (Faker $faker) {
    return [
        'type' => collect(['staging', 'production'])->random(),
        'url' => $faker->url,
        'website_username' => $faker->userName,
        'website_password' => $faker->password,
        'ip_address' => $faker->ipv4,
        'directory' => '/var/wwww/' . $faker->word,
        'ssh_user' => $faker->userName,
        'ssh_key' => '$AGILE_KEY'
    ];
});

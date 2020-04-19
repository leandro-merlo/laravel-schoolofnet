<?php

use App\Models\Client;
use App\Utils\CpfCnpjRandom;
use Faker\Generator as Faker;

$factory->define(App\Models\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'defaulter' => rand(0,1),
    ];
});

$factory->state(Client::class, Client::TYPE_INDIVIDUAL, function (Faker $faker) {
    return [
        'document_number' => CpfCnpjRandom::cpfRandom(0),
        'date_birth' => $faker->date(),
        'sex' =>  rand(1,10) % 2 == 0 ? 'm' : 'f',
        'marital_status' => rand(1,3),
        'physical_disability' => rand(1,10) % 2 ? $faker->word : null,
        'client_type' => Client::TYPE_INDIVIDUAL
    ];
});

$factory->state(Client::class, Client::TYPE_LEGAL, function (Faker $faker) {
    return [
        'document_number' => CpfCnpjRandom::cnpjRandom(0),
        'company_name' => $faker->company,
        'client_type' => Client::TYPE_LEGAL
    ];
});
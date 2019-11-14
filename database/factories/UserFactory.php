<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'company_id' => 1,
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'phone' => $faker->phoneNumber,
        'status' => 'active',
        'gender' => 'male',
        'role' => 'witness', //['customer', 'witness', 'staff']
        'dob' => date('Y-m-d'),
        'created_by' => 1,
        'remember_token' => Str::random(10)
    ];
});

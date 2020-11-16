<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'dni' =>  $faker->randomNumber(8, $strict = true),
        'address' => $faker->address,
        'phone' => $faker->e164PhoneNumber,
        'role' => $faker->randomElement(['patient', 'doctor'])
    ];
});

$factory->state(App\User::class, 'patient', [
    'role' => 'patient'
]);

$factory->state(App\User::class, 'doctor', [
    'role' => 'doctor'
]);

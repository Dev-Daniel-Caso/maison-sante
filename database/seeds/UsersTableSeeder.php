<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Daniel Caso Quintanilla',
            'email' => 'admin@fadel.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
            'dni' =>  '76165238',
            'address' => 'Mi Casa',
            'phone' => '',
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Fatima Quintanilla',
            'email' => 'doctor@fadel.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
            'dni' =>  '76165239',
            'address' => 'Mi Casa',
            'phone' => '',
            'role' => 'doctor'
        ]);
        User::create([
            'name' => 'Diego Quintanilla',
            'email' => 'patient@fadel.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
            'dni' =>  '76165240',
            'address' => 'Mi Casa',
            'phone' => '',
            'role' => 'patient'
        ]);
        factory(User::class, 50)->states('patient')->create();
    }
}

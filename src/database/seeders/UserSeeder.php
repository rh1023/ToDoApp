<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => '日榮',
            'email' => 'hiei@test.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => '坪石',
            'email' => 'tubo@test.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => '太郎',
            'email' => 'taro@test.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => '次郎',
            'email' => 'jiro@test.com',
            'password' => Hash::make('password'),
        ]);
    }
}

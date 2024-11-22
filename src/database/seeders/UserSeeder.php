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
            'email' => 'tsuboishi@test.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => '二村',
            'email' => 'futamura@test.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => '山田',
            'email' => 'yamada@test.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => '古川',
            'email' => 'furukawa@test.com',
            'password' => Hash::make('password'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => '太郎',
            'email' => 'taro@test.com',
            'password' => 'password'
        ]);

        User::factory()->create([
            'name' => '次郎',
            'email' => 'jiro@test.com',
            'password' => 'password'
        ]);


    }
}

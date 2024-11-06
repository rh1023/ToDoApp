<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
                'id' => 'hiei1023',
                'password' => 'password123',
                'name' => '日榮',
            // 必要に応じて追加のユーザーをここに追加
        ];

    }
}

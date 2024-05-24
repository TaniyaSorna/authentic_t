<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'id' => 6,
                'name' => 'John Doe',
                'email' => 'john1@gmail.com',
                'password' => '123'
            ],
            [
                'id' => 7,
                'name' => 'Jemmy Doe',
                'email' => 'jemmy1@gmail.com',
                'password' => '123'
            ]
        ]);
    }
}

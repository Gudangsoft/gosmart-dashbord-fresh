<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gosmart.id'],
            [
                'name'              => 'Administrator',
                'password'          => bcrypt('admin123'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}

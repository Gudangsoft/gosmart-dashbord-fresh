<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfileGacademy;

class ProfileGacademySeeder extends Seeder
{
    public function run(): void
    {
        ProfileGacademy::updateOrCreate(
            ['id' => 1],
            [
                'name'    => 'GoSmart',
                'email'   => 'admin@gosmart.id',
                'hp'      => '08123456789',
                'link'    => 'https://gosmart.id',
                'address' => 'Indonesia',
                'logo'    => 'logo.png',
                'status'  => 'p',
                'add_by'  => '1',
            ]
        );
    }
}

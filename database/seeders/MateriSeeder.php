<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;
use App\view_stream;


class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // use original seeder
        // view_stream::insert([
        //     'link' => 'dTaHF_9U_IE',
        //     'judul' => 'Membuat seeder dengan laravel faker',
        //     'keterangan' => 'tuttorial membuat seeder dengan laravel faker',
        //     'level' => 1,
        //     'gambar' => 'view_stream-33-bulb-2352163.jpg',
        //     'chanel_id' => 32,
        //     'class_id' => 35,
        //     'status' => 'p',
        //     'tags' => 'tutorial,laravel,faker',
        //     'created_at' => Carbon::now('Asia/jakarta'),
        // ]);

        // use faker seeder
        $faker = Faker::create('id_ID');
        for($i = 1; $i <=100; $i++){
            view_stream::insert([
                'link' => 'dTaHF_9U_IE',
                'judul' => $faker->text(20),
                'keterangan' => $faker->text(50),
                'level' => 1,
                'gambar' => 'view_stream-33-bulb-2352163.jpg',
                'chanel_id' => 32,
                'class_id' => $faker->numberBetween(34,38),
                'status' => 'p',
                'tags' => 'tutorial,laravel,faker',
                'premium' => $faker->numberBetween(0,1),
                'visitor' => $faker->numberBetween(34,436),
                'created_at' => Carbon::now('Asia/jakarta'),
            ]);
        }
    }
}

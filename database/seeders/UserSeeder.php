<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use App\Models\Requests;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'=>'ICPC Minya',
            'email'=>'icpcminya@gmail.com',
            'password'=>bcrypt('icpcminyaicpcminyaicpc123456789')
        ]);
       /* $faker=Factory::create('en_US');
        for($i=0; $i<100;$i++)
        {
            AboutPage::create([
                'name' => $faker->name,
                'job' => '01064238398',
                'description' => '01064238398',
                'img'=>'1634836424.jpg'

            ]);
        }*/
    }
}

<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use App\Models\Topics;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker=Factory::create('en_US');
        for($i=0; $i<100;$i++)
        {
            Topics::create([
                'name' => $faker->name,


            ]);
        }
    }
}

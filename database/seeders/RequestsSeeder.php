<?php

namespace Database\Seeders;
use App\Models\Requests;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RequestsSeeder extends Seeder
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
        for($i=0; $i<10000;$i++)
        {
           Requests::create([
                'name' => $faker->name,
                'phone' => '01064238398',
                'handle' =>"NeVeDlE",
               'email' =>"shaherabdullah2000@gmail.com",
               'national' =>"11111111111113",
               'university' =>"1",
               'faculty' =>"1",
               'training' =>"1",
               'year' =>"1",
               'status' =>"2",
            ]);
        }
    }
}

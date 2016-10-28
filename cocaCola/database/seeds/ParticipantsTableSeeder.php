<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('participants')->delete();

        $faker = Faker::create();


        for ($i = 0; $i < 50; $i++) {
            $partisepants = array(
                array(
                    'ip_Adres' => '192.36.58.12',
                    'name' => $faker->name,
                    'address' => $faker->address,
                    'location' => $faker->country,
                    'email' => $faker->email,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );

            DB::table('participants')->insert($partisepants);
        }

    }
}

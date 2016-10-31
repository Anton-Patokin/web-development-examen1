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

        DB::table('users')->delete();
        DB::table('contests')->delete();
        DB::table('participants')->delete();
        DB::table('contest_participant')->delete();


        $contest = array(
            'name' => "google",
            'date_start' => \Carbon\Carbon::now()->startOfDay(),
            'date_end' => \Carbon\Carbon::now()->addWeeks(2),
            'email' => "paraplu",
            'type' => "Google-maps",
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        );

        DB::table('contests')->insert($contest);

        for ($i = 0; $i < 50; $i++) {
            $faker = Faker::create();
            $name =$faker->name;
            $users = array(
                array(
                    'name' => $name,
                    'email' => $faker->email,
                    'password' => Hash::make(123456),
                    'admin' => 0,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
            DB::table('users')->insert($users);


            $partisepants = array(
                array(
                    'ip_Adres' => '192.36.58.12',
                    'name' => $name,
                    'address' => $faker->address,
                    'location' => $faker->country,
                    'email' => $faker->email,
                    'user_id'=>$manufacturer = DB::table('users')
                        ->where('name', '=', $name)
                        ->select('id')->first()->id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
            $parisipant = DB::table('participants')->insert($partisepants);


            $contest_partisipant = array(
                array(
                    'contest_id' => DB::table('contests')
                        ->where('name', '=', "google")
                        ->select('id')->first()->id,

                    'participant_id' => DB::table('participants')
                        ->where('name', '=', $name)
                        ->select('id')->first()->id,

                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
            DB::table('contest_participant')->insert($contest_partisipant);

        }



    }
}

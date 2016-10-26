<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class partisepants extends Seeder{
    public  function  run(){
        DB::table('participants')->delete();

        $faker= Faker::create();


        for($i=0;$i<50;$i++){
            $partisepants = array(
                array(
                    'ipAdres'=>'192.36.58.12',
                    'name'=>$faker->name,
                    'adres'=>$faker->address,
                    'location'=>$faker->country,
                    'email'=>$faker->email,
                    'Contestdatums_id'=>$faker->numberBetween(1,20),
                    'created_at'=>\Carbon\Carbon::now(),
                    'updated_at'=>\Carbon\Carbon::now(),
                    )
            );

            DB::table('participants')->insert($partisepants);
        }
    }
}

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(partisepants::class);
    }
}

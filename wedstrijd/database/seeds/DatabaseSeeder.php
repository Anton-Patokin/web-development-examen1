<?php

use Illuminate\Database\Seeder;

class partisepants extends Seeder{
    public  function  run(){
        DB::table('participants')->delete();

        $partisepants = array(
            array(
                'ipAdres'=>'192.36.58.12',
                'name'=>'paraplu',
                'adres'=>'de bosscheartstraat 22',
                'location'=>'antwerpen',
                'email'=>'paraplu@list.ru',
                'Contestdatums_id'=>'16'
            )
        );

        DB::table('participants')->insert($partisepants);
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

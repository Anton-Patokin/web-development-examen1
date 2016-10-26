<?php

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
            )
        );

        DB::table('participants')->insert($partisepants);
    }
}
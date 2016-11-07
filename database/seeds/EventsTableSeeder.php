<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
        factory('App\ClientEvent', 30)->create();
    }
}

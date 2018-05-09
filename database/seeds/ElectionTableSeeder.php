<?php

use Illuminate\Database\Seeder;

class ElectionTableSeeder extends Seeder
{
    public function run()
    {
        factory('App\Election', 30)->create();
    }
}

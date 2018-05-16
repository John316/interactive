<?php

use Illuminate\Database\Seeder;
use App\Models\EventStatuses;

class EventStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventStatuses::create(['title'=>'Online']);
        EventStatuses::create(['title'=>'Active']);
        EventStatuses::create(['title'=>'Inactive']);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    protected $toTrancate = ['client_events', 'users'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();

        foreach ($this->toTrancate as $table)
        {
          //DB::table($table)->truncate();
        }

        $this->call(UsersTableSeeder::class);

        $this->call(EventsTableSeeder::class);

        //TODO: $this->call(ElectionTableSeeder::class);
    }
}

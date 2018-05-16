<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    protected $toTrancate = ['client_events', 'users', 'elections'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($this->toTrancate as $table)
        {
          DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call(UserTableSeeder::class);

        $this->call(EventsTableSeeder::class);

        $this->call(ElectionTableSeeder::class);

        $this->call(QuestionsSeeder::class);
    }
}

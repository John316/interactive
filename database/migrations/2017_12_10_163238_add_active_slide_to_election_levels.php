<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveSlideToElectionLevels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('election_levels', function (Blueprint $table) {
            $table->string('active_slide')->after('election_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('election_levels', function (Blueprint $table) {
            $table->dropColumn('active_slide');
        });
    }
}

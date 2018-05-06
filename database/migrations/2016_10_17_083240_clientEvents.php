<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('desc');
            $table->integer('status');
            $table->dateTime('active_from');
            $table->dateTime('active_to');
            $table->timestamps();
        });

        Schema::create('client_event_user', function (Blueprint $table) {
            $table->integer('client_event_id')->unsigned()->index();
            $table->foreign('client_event_id')->references('id')->on('client_events')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('client_event_user');
        Schema::dropIfExists('client_events');
        Schema::enableForeignKeyConstraints();
    }
}

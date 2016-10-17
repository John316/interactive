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
            $table->dateTime('activeFrom');
            $table->dateTime('activeTo');
            $table->timestamps();
        });

        Schema::create('event_user', function (Blueprint $table) {
            $table->integer('client_event_id')->unsigned()->index();
            $table->foreign('client_event_id')->references('id')->on('client_events')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::drop('client_events');
        Schema::drop('event_user');
    }
}

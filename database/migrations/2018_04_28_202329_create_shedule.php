<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shedule', function (Blueprint $table){
            $table->increments('id');
            $table->integer('date');
            $table->integer('user_id');
            $table->integer('direction_id');
            $table->integer('lesson_id');
            $table->integer('room_id');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lesson')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('direction_id')->references('id')->on('direction')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('room')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shedule');
    }
}

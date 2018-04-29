<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExecuteDirection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('execute_direction', function (Blueprint $table){
            $table->increments('id');
            $table->integer('direction_id');
            $table->integer('execute_id');

            $table->foreign('direction_id')->references('id')->on('direction')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('execute_id')->references('id')->on('execute')
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
        Schema::drop('execute_direction');
    }
}

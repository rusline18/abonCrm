<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit', function (Blueprint $table){
            $table->increments('id');
            $table->integer('shedule_id');
            $table->integer('season_id');
            $table->integer('status');
            $table->integer('created_at');
            $table->integer('updated_at');

            $table->foreign('shedule_id')->references('id')->on('shedule')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('season')
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
        Schema::drop('visit');
    }
}

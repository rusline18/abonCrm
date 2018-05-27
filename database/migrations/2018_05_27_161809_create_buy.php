<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_season', function (Blueprint $table){
           $table->increments('id');
           $table->integer('season_id');
           $table->integer('client_id');
           $table->integer('user_id');
           $table->integer('created_at');
           $table->integer('updated_at');

           $table->foreign('season_id')->references('id')->on('season')
               ->onUpdate('cascade')
               ->onDelete('cascade');
           $table->foreign('client_id')->references('id')->on('client')
               ->onUpdate('cascade')
               ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::drop('buy_season');
    }
}

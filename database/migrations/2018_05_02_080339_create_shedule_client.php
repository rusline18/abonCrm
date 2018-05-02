<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheduleClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shedule_client', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('shedule_id');
           $table->integer('client_id');
           $table->integer('created_at');
           $table->integer('updated_at');

           $table->foreign('shedule_id')->references('id')->on('shedule')
               ->onUpdate('cascade')
               ->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('client')
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
        Schema::drop('shedule_client');
    }
}

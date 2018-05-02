<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExecuteId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shedule', function (Blueprint $table) {
           $table->integer('execute_id')->nullable();

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
        Schema::table('shedule', function (Blueprint $table) {
           $table->dropColumn('execute_id');
        });
    }
}

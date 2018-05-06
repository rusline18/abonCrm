<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCreatedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shedule_client', function (Blueprint $table){
           $table->dropColumn('created_at');
           $table->dropColumn('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shedue_client', function (Blueprint $table){
            $table->integer('created_at')->default(time());
            $table->integer('updated_at')->default(time());
        });
    }
}

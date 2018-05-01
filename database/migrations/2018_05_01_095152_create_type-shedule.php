<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeShedule extends Migration
{
    /**
     * Добавляет тип в расписание Групповые/Индивидуальные занятие
     * Удаление колонки lesson_id
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shedule', function (Blueprint $table) {
           $table->integer('type');
           $table->dropColumn('lesson_id');
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
           $table->dropColumn('type');
        });
    }
}

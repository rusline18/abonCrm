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
           $table->time('time_start');
           $table->time('time_end');
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
           $table->integer('lesson_id');
           $table->dropColumn(['type', 'time-start', 'time-end']);

            $table->foreign('lesson_id')->references('id')->on('lesson')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }
}

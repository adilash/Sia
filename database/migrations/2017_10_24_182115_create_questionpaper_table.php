<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionpaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('QUESTIONPAPER', function (Blueprint $table) {
            $table->increments('qsid');
            $table->string('CourseID',8);
            $table->integer('ProgrammeID')->unsigned();

            $table->integer('Year');
            $table->string('TestType',5);
            $table->string('link',75);
        });
        Schema::table('QUESTIONPAPER',
            function(Blueprint $table
            ){
            $table->foreign('ProgrammeID')->references('ProgrammeID')->on('PROGRAMME');
            $table->foreign('CourseID')->references('CourseID')->on('COURSE');

            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('QUESTIONPAPER');
    }
}

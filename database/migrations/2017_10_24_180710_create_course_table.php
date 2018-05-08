<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('COURSE', function (Blueprint $table) {
            $table->string('CourseID',8)->primary();
            $table->string('CourseName',50);
            $table->integer('ProgrammeID')->unsigned();
            
        });
        Schema::table('COURSE',
            function(Blueprint $table
            ){
                $table->foreign('ProgrammeID')->references('ProgrammeID')->on('PROGRAMME');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('COURSE');
    }
}

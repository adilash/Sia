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
            $table->integer('DepartmentID')->unsigned();
            
        });
        Schema::table('COURSE',
            function(Blueprint $table
            ){
                $table->foreign('DepartmentID')->references('DepartmentID')->on('DEPARTMENT');
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

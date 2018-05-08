<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PROGRAMME', function (Blueprint $table) {
            $table->increments('ProgrammeID');
            $table->string('ProgrammeName',8);
            $table->integer('DepartmentID')->unsigned();

        });
        Schema::table('PROGRAMME',
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
        Schema::dropIfExists('PROGRAMME');
    }
}

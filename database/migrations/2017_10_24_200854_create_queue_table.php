<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('QUEUE', function (Blueprint $table) {
            $table->increments('qid');
            $table->string('CourseID',8);
        
            $table->integer('Year');
            $table->string('TestType',5);
            $table->string('link',75);
            $table->string('email',45);
        });
        Schema::table('QUEUE',
            function(Blueprint $table
            ){
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
        Schema::dropIfExists('QUEUE');
    }
}

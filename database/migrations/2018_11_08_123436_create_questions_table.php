<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('question_type_id')->unsigned();
            $table->integer('page_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('question_type_id')->on('question_types')->references('id')->onDelete('cascade');
            $table->foreign('page_id')->on('pages')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}

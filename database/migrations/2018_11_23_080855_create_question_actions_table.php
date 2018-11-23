<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('conditions');
            $table->integer('action_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('action_id')->on('actions')->references('id')->onDelete('cascade');
            $table->foreign('question_id')->on('questions')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_actions');
    }
}

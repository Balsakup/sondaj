<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('ended_at')->nullable();
            $table->integer('survey_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('survey_id')->on('surveys')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_replies');
    }
}

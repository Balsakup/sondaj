<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPositionToPositionable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ([ 'pages' => 'survey_id', 'questions' => 'page_id', 'answers' => 'question_id' ] as $table => $field) {
            Schema::table($table, function (Blueprint $table) {
                $table->integer('position')->default(0);
            });


        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ([ 'pages', 'questions', 'answers' ] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('position');
            });
        }
    }
}

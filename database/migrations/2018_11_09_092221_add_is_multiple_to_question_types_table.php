<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsMultipleToQuestionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_types', function (Blueprint $table) {
            $table->boolean('is_multiple')->after('name')->default(false);
        });

        DB::table('question_types')
            ->where('name', '=', 'checkbox')
            ->orWhere('name', '=', 'radio')
            ->update([ 'is_multiple' => true ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_types', function (Blueprint $table) {
            $table->dropColumn('is_multiple');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('topic_id');
            $table->string("question_number");
            $table->string('question_type');

            $table->string("question_code");
            $table->string('question');
            $table->string("question_en")->nullable();

            $table->string("options_code")->nullable();
            $table->string('options')->nullable();
            $table->string("options_en")->nullable();

            $table->string("required");
            $table->string("next_question")->nullable();
            $table->timestamps();
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

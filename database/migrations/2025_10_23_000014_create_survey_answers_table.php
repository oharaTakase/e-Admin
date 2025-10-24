<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('survey_answers', function (Blueprint $table) {
            $table->id('answer_id');
            
            // 外部キー (survey_responses.response_id を参照)
            $table->foreignId('response_id')->constrained('survey_responses', 'response_id')->onDelete('cascade');
            
            // 外部キー (survey_questions.question_id を参照)
            $table->foreignId('question_id')->constrained('survey_questions', 'question_id')->onDelete('cascade');
            
            $table->text('answer_text')->nullable();
            
            // 外部キー (survey_question_options.option_id を参照)
            // ON DELETE SET NULL を指定
            $table->foreignId('selected_option_id')->nullable()->constrained('survey_question_options', 'option_id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_answers');
    }
};
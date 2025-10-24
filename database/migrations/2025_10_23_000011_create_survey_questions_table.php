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
        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id('question_id');
            
            // 外部キー (surveys.survey_id を参照)
            $table->foreignId('survey_id')->constrained('surveys', 'survey_id')->onDelete('cascade');
            
            $table->text('question_text');
            $table->string('question_type', 50);
            $table->boolean('is_required')->default(false);
            $table->integer('display_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_questions');
    }
};
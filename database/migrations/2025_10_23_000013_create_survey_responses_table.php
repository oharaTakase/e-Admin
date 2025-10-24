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
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id('response_id');
            
            // 外部キー (surveys.survey_id を参照)
            $table->foreignId('survey_id')->constrained('surveys', 'survey_id')->onDelete('cascade');
            
            // 外部キー (users.user_id を参照)
            $table->foreignId('respondent_id')->constrained('users', 'user_id')->onDelete('cascade');
            
            $table->timestamp('submitted_at')->useCurrent();
            
            // ユニークキー
            $table->unique(['survey_id', 'respondent_id'], 'unique_survey_respondent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
    }
};
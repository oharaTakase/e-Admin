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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id('preference_id');
            
            // 外部キー (users.user_id を参照)
            $table->foreignId('user_id')->unique()->constrained('users', 'user_id')->onDelete('cascade');
            
            $table->string('calendar_view_mode', 20)->default('month');
            $table->string('note_sort_order', 50)->default('priority-deadline');
            $table->string('theme', 20)->default('light');
            $table->boolean('notifications_enabled')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
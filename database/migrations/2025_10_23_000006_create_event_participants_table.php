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
        Schema::create('event_participants', function (Blueprint $table) {
            // 外部キー (events.event_id を参照)
            $table->foreignId('event_id')->constrained('events', 'event_id')->onDelete('cascade');
            
            // 外部キー (users.user_id を参照)
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            
            $table->string('response_status', 20)->default('pending');
            
            // 複合主キー
            $table->primary(['event_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_participants');
    }
};
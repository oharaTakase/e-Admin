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
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            
            // 外部キー (calendars.calendar_id を参照)
            $table->foreignId('calendar_id')->constrained('calendars', 'calendar_id');
            
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('url', 500)->nullable();
            $table->string('category', 50)->default('会議');
            $table->string('importance', 20)->default('中');
            $table->date('start_date');
            $table->time('start_time')->nullable();
            $table->date('end_date');
            $table->time('end_time')->nullable();
            $table->boolean('is_all_day')->default(false);
            
            // 外部キー (users.user_id を参照)
            $table->foreignId('created_by')->constrained('users', 'user_id');
            
            $table->boolean('is_deleted')->default(false)->index(); // インデックス追加
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            // SQLで指定されたインデックス
            $table->index(['start_date', 'end_date'], 'idx_events_dates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
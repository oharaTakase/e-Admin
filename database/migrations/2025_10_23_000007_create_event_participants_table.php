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
        Schema::create('event_recurrence', function (Blueprint $table) {
            $table->id('recurrence_id');
            
            // 外部キー (events.event_id を参照)
            $table->foreignId('event_id')->unique()->constrained('events', 'event_id')->onDelete('cascade');
            
            $table->string('recurrence_type', 20);
            $table->integer('recurrence_interval')->default(1);
            $table->string('recurrence_unit', 20)->nullable();
            $table->date('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_recurrence');
    }
};
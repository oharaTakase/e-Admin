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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id('reminder_id');
            
            // 外部キー (users.user_id を参照)
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('deadline')->index(); // インデックス追加
            $table->string('category', 50)->default('業務');
            $table->boolean('completed')->default(false)->index(); // インデックス追加
            $table->timestamp('completed_at')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
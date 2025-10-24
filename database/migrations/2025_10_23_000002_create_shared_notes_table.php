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
        Schema::create('shared_notes', function (Blueprint $table) {
            $table->id('note_id');
            $table->string('title');
            $table->text('content')->nullable();
            
            // 外部キー (users.user_id を参照)
            $table->foreignId('author_id')->constrained('users', 'user_id');
            
            $table->string('color', 50)->default('yellow');
            $table->string('priority', 20)->default('medium');
            $table->date('deadline')->nullable();
            $table->boolean('pinned')->default(false);
            $table->boolean('is_deleted')->default(false)->index(); // インデックス追加
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            // SQLで指定されたインデックス
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_notes');
    }
};
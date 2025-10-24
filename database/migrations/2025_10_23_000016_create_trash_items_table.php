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
        Schema::create('trash_items', function (Blueprint $table) {
            $table->id('trash_id');
            
            // 外部キー (users.user_id を参照)
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            
            $table->string('item_type', 50);
            $table->unsignedBigInteger('item_id');
            $table->string('original_title')->nullable();
            $table->timestamp('deleted_at')->useCurrent();
            $table->timestamp('permanent_delete_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trash_items');
    }
};
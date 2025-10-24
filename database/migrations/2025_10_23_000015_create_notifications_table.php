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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            
            // 外部キー (users.user_id を参照)
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade')->index(); // インデックス追加
            
            $table->string('notification_type', 50);
            $table->unsignedBigInteger('reference_id'); // ポリモーフィックな関連のため、外部キー制約は設定しない
            $table->string('title');
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(false)->index(); // インデックス追加
            $table->timestamp('read_at')->nullable();
            $table->timestamp('created_at')->useCurrent()->index(); // インデックス追加
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
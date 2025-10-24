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
        Schema::create('note_tag_relations', function (Blueprint $table) {
            // 外部キー (shared_notes.note_id を参照)
            $table->foreignId('note_id')->constrained('shared_notes', 'note_id')->onDelete('cascade');
            
            // 外部キー (note_tags.tag_id を参照)
            $table->foreignId('tag_id')->constrained('note_tags', 'tag_id')->onDelete('cascade');
            
            // 複合主キー
            $table->primary(['note_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_tag_relations');
    }
};
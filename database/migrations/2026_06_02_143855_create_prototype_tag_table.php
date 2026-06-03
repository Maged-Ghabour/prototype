<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_prototype_tag_table
 * جدول الربط بين النماذج والوسوم (many-to-many)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prototype_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prototype_id')
                  ->constrained('prototypes')
                  ->cascadeOnDelete();
            $table->foreignId('tag_id')
                  ->constrained('tags')
                  ->cascadeOnDelete();
            $table->unique(['prototype_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prototype_tag');
    }
};

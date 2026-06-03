<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: add_category_id_to_prototypes_table
 * إضافة عمود التصنيف لجدول النماذج
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prototypes', function (Blueprint $table) {
            $table->foreignId('category_id')
                  ->nullable()
                  ->after('is_public')
                  ->constrained('categories')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('prototypes', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Category::class);
            $table->dropColumn('category_id');
        });
    }
};

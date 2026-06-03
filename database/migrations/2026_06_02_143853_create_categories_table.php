<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_categories_table
 * جدول تصنيفات النماذج التجريبية
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // اسم التصنيف
            $table->string('slug')->unique();           // المعرّف الفريد
            $table->text('description')->nullable();    // وصف اختياري
            $table->string('color', 7)->default('#6d28d9'); // لون hex للشارة
            $table->integer('sort_order')->default(0); // ترتيب العرض
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_tags_table
 * جدول الوسوم (Tags) للنماذج التجريبية
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');               // اسم الوسم
            $table->string('slug')->unique();     // المعرّف الفريد
            $table->string('color', 7)->default('#0ea5e9'); // لون hex للشارة
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};

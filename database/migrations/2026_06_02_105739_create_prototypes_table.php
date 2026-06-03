<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_prototypes_table
 *
 * Creates the `prototypes` table which stores AI-generated HTML/CSS/JS prototypes.
 * Each prototype can be shared with clients via a unique public URL.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prototypes', function (Blueprint $table) {
            $table->id();

            // Human-readable title for the prototype
            $table->string('title');

            // URL-friendly unique slug used in the public preview route /p/{slug}
            $table->string('slug')->unique();

            // The three code components of the prototype
            $table->longText('html_code')->nullable();
            $table->longText('css_code')->nullable();
            $table->longText('js_code')->nullable();

            // Controls whether the prototype is publicly accessible
            $table->boolean('is_public')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prototypes');
    }
};

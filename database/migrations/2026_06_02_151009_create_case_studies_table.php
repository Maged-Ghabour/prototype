<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('client_name');
            $table->string('slug')->unique();
            $table->string('industry')->nullable();
            $table->text('short_description')->nullable();
            
            $table->longText('challenge')->nullable();
            $table->longText('solution')->nullable();
            $table->longText('results')->nullable();
            
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            
            $table->foreignId('prototype_id')->nullable()->constrained('prototypes')->nullOnDelete();
            
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_studies');
    }
};

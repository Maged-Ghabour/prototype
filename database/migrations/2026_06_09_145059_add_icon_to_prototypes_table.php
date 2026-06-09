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
        Schema::table('prototypes', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('is_visible_on_home');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prototypes', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
};

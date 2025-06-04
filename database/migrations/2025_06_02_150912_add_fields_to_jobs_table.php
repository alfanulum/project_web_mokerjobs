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
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('education_level')->nullable();     // Minimal pendidikan
            $table->integer('experience_years')->nullable();   // Minimal pengalaman
            $table->string('salary')->nullable();              // Gaji (format bebas)
            $table->string('apply_link')->nullable();          // Link Google Form
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
        });
    }
};

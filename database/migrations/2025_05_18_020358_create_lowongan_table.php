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
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('job_name', 50);
            $table->string('category_job', 50);
            $table->string('job_type', 50);
            $table->string('place_work', 50);
            $table->string('type_gender', 50);
            $table->string('education_minimal', 50);
            $table->string('experience_minimal', 50);
            $table->string('age', 50);
            $table->text('job_description');
            $table->text('job_requirements');
            $table->decimal('salary_minimal_range', 12, 2);
            $table->decimal('maximum_salary_range', 12, 2);
            $table->string('location', 200);
            $table->string('image_banner', 255)->nullable();
            $table->string('company_name', 50);
            $table->text('company_description');
            $table->text('company_address');
            $table->string('social_media_company', 50);
            $table->string('company_industry', 50);
            $table->string('company_logo_image', 255)->nullable();
            $table->string('email_company', 50);
            $table->string('no_wa_company', 50);
            $table->dateTime('delivery_limit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};

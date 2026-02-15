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
        Schema::create('career_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('years_experience');
            $table->foreignId('major_id')->constrained();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('cv_path'); // مسار ملف السيرة الذاتية
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_submissions');
    }
};

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
        Schema::create('academic_levels', function (Blueprint $table) {
            $table->id();
            // $table->string('name_ar'); // الاسم بالعربية
            // $table->string('name_en'); // الاسم بالإنجليزية
            $table->json('name'); // تخزين الأسماء بعدة لغات
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_levels');
    }
};

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
        // جدول projects
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();     // لو عايز روابط زي /project/my-app
            $table->text('description');
            $table->text('short_description')->nullable(); // للعرض في الكارت
            $table->json('technologies')->nullable(); // ["Laravel","Flutter","MySQL"]
            $table->string('github_link')->nullable();
            $table->string('live_link')->nullable();
            $table->string('cover_image')->nullable();
            $table->boolean('is_featured')->default(false); // يظهر في الصفحة الرئيسية
            $table->date('started_at')->nullable();
            $table->date('finished_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

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
        Schema::create('video_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable()->default('Interactive Showcase');
            $table->string('title')->default('Get To Know Me & Connect');
            $table->text('subtitle')->nullable();
            $table->string('video_path');
            $table->string('cover_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('video_content_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_section_id')->constrained('video_sections')->cascadeOnDelete();
            $table->string('title');
            $table->string('value')->nullable();
            $table->string('url')->nullable();
            $table->string('icon')->nullable()->default('fa-solid fa-link');
            $table->string('badge')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_content_items');
        Schema::dropIfExists('video_sections');
    }
};
